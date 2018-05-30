<?php

    class Category {

        public static function getCategoryList() {

            $db = Db::getConnection();
            $query = "SELECT * FROM category";
            $result = $db->query($query);
            $num = $result->num_rows;

            $categoryList = array();

            for($i = 0; $i < $num; ++$i) {
                $result->data_seek($i);
                $row = $result->fetch_array(MYSQLI_ASSOC);
                $categoryList[$i]['id'] = $row['id'];
                $categoryList[$i]['name'] = $row['name'];
                $categoryList[$i]['sort_order'] = $row['sort_order'];
                $categoryList[$i]['status'] = $row['status'];
            }
            return $categoryList;
        }

        public static function getCategoryById($id) {

            $db = Db::getConnection();
            $query = "SELECT * FROM category WHERE id = '$id'";

            $result = $db->query($query);
            $result->data_seek(0);
            $category = $result->fetch_array(MYSQLI_ASSOC);

            return $category;
        }

        public static function deleteCategory($id) {

            $db = Db::getConnection();

            $query = "DELETE FROM category WHERE id = '$id'";
            $result = $db->query($query);

            return $result;
        }

        public static function createCategory($name, $sort_order, $status) {

            $db = Db::getConnection();

            $query = "INSERT INTO category (name, sort_order, status) VALUES ('$name', '$sort_order', '$status')";
            $result = $db->query($query);

            return $result;
        }

        public static function updateCategory($id, $category) {

            $db = Db::getConnection();

            $query = "UPDATE category SET name = '$category[name]', sort_order = '$category[sort_order]',"
            ."status = '$category[status]' WHERE id = '$id'";

            $result = $db->query($query);

            return $result;
        }
    }