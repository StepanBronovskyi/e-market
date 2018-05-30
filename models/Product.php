<?php

    class Product {

        // отримуємо список товарів якщо
        // SiteController викликає getProductsList без параметрів - отримуємо всі товари(останніх 6)
        // CatalogController викликає getProductsList з параметрм $page - отрим. товари для певної сторікки в каталозі
        public static function getProductsList($page = 0) {
            $db = Db::getConnection();
            if($page) {
                $limit = 6;
                $offset = ($page - 1) * $limit;
                $query = "SELECT * FROM product WHERE status='1' LIMIT $limit OFFSET $offset";
            }
            else {
                $limit = 6;
                $query = "SELECT * FROM product WHERE status='1' ORDER BY id DESC LIMIT $limit";
            }
            $result = $db->query($query);
            $num = $result->num_rows;

            $productsList = array();

            for($i = 0; $i < $num; ++$i) {
                $result->data_seek($i);
                $row = $result->fetch_array(MYSQLI_ASSOC);
                $productsList[$i]['name'] = $row['name'];
                $productsList[$i]['id'] = $row['id'];
                $productsList[$i]['price'] = $row['price'];
                $productsList[$i]['image'] = $row['image'];
                $productsList[$i]['brand'] = $row['brand'];
            }
            return $productsList;
        }

        // отримуєм інфу про товар
        public static function getProductById($id) {
            $db = Db::getConnection();
            $productItem = array();

            $query = "SELECT * FROM product WHERE id='$id'";
            $result = $db->query($query);

            $result->data_seek(0);
            $row = $result->fetch_array(MYSQLI_ASSOC);

            return $row;
        }

        // отримуємо список товарів певної категорії і певної сторінки в каталозі
        public static function getProductsByCategoryId($id, $page = 1) {
            $productsList = array();
            $limit = 6;
            $offset = ($page-1)*$limit;
            $db = Db::getConnection();
            $query = "SELECT * FROM product WHERE category_id='$id' ORDER BY id DESC LIMIT $limit OFFSET $offset";
            $result = $db->query($query);
            $num = $result->num_rows;

            $productsList = array();

            for($i = 0; $i < $num; ++$i) {
                $result->data_seek($i);
                $row = $result->fetch_array(MYSQLI_ASSOC);
                $productsList[$i]['name'] = $row['name'];
                $productsList[$i]['id'] = $row['id'];
                $productsList[$i]['price'] = $row['price'];
                $productsList[$i]['image'] = $row['image'];
                $productsList[$i]['brand'] = $row['brand'];
            }

            return $productsList;
        }

        public static function getCountProductsInCategory($id) {
            $db = Db::getConnection();
            $query = "SELECT * FROM product WHERE category_id='$id'";
            $result = $db->query($query);
            $num = $result->num_rows;
            return $num;
        }

        public static function getCountProducts() {
            $db = Db::getConnection();
            $query = "SELECT * FROM product";
            $result = $db->query($query);
            $num = $result->num_rows;
            return $num;
        }

        public static function getProdustsByIds($idsArray){
            $products = array();

            $db = Db::getConnection();

            $idsString = implode(',', $idsArray);

            $sql = "SELECT * FROM product WHERE id IN ($idsString)";

            $result = $db->query($sql);
            $num = $result->num_rows;

            for ($i = 0; $i < $num; ++$i) {
                $result->data_seek($i);
                $row = $result->fetch_array(MYSQLI_ASSOC);
                $products[$i]['id'] = $row['id'];
                $products[$i]['code'] = $row['code'];
                $products[$i]['name'] = $row['name'];
                $products[$i]['price'] = $row['price'];
            }

            return $products;
        }

        public static function getRecomendedProducts() {

            $db = Db::getConnection();

            $query = "SELECT * FROM product WHERE is_recomended = '1'";
            $result = $db->query($query);

            $recomendedProducts = array();

            $num = $result->num_rows;
            for($i = 0; $i < $num; ++$i) {
                $result->data_seek($i);
                $row = $result->fetch_array(MYSQLI_ASSOC);
                $recomendedProducts[$i]['id'] = $row['id'];
                $recomendedProducts[$i]['name'] = $row['name'];
                $recomendedProducts[$i]['price'] = $row['price'];
                $recomendedProducts[$i]['is_new'] = $row['is_new'];
            }
            return $recomendedProducts;
        }

        public static function deleteProductById($id) {

            $db = Db::getConnection();

            $query = "DELETE FROM product WHERE id = '$id'";
            $result = $db->query($query);

            return $result;
        }


        public static function deleteProductsByCategoryId($cat_id) {

            $db = Db::getConnection();

            $query = "DELETE FROM product WHERE category_id = '$cat_id'";
            $result = $db->query($query);

            return $result;
        }

        public static function createProduct($item) {

            $db = Db::getConnection();

            $query = "INSERT INTO product (name, category_id, code, price, availabilaty, brand, image, description, is_new,"
                ."is_recomended, status) VALUES ('$item[name]', '$item[category_id]', '$item[code]', '$item[price]', '$item[availability]',"
                ."'$item[brand]', '$item[image]', '$item[description]', '$item[is_new]', '$item[is_recommended]', '$item[status]')";

            $result = $db->query($query);

            return $result;
        }

        public static function updateProductById($id, $item) {

            $db = Db::getConnection();

            $query = "UPDATE product SET name = '$item[name]', category_id = '$item[category_id]', code = '$item[code]',"
            ."price = '$item[price]', availabilaty = '$item[availability]',  brand = '$item[brand]', image = '$item[image]',"
            ."description = '$item[description]', is_new = '$item[is_new]', is_recomended = '$item[is_recommended]',"
            ."status = '$item[status]' WHERE id = '$id'";

            $result = $db->query($query);

            return $result;
        }

        public static function lastInsertProductId() {

            $db = Db::getConnection();
            $query = "SELECT * FROM product ORDER BY id DESC LIMIT 1";

            $result = $db->query($query);

            $result->data_seek(0);
            $row = $result->fetch_array(MYSQLI_ASSOC);

            return $row['id'];
        }
    }