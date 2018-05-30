<?php

    class AdminProductController extends AdminBasic {

        public function actionIndex() {

            self::checkAdmin();

            $productsList = Product::getProductsList();
            include (ROOT."/views/admin_product/index.php");
            return true;
        }

        public function actionDelete($id) {

            self::checkAdmin();

            if($_POST['submit']) {
                Product::deleteProductById($id);
                header("Location: /admin/product");
            }
            include (ROOT."/views/admin_product/delete.php");
            return true;
        }

        public function actionUpdate($id) {

            self::checkAdmin();

            if($_POST['submit']) {
                $option['name'] = $_POST['name'];
                $option['code'] = $_POST['code'];
                $option['price'] = $_POST['price'];
                $option['category_id'] = $_POST['category_id'];
                $option['brand'] = $_POST['brand'];
                $option['description'] = $_POST['description'];
                $option['category_id'] = $_POST['category_id'];
                $option['availability'] = $_POST['availability'];
                $option['category_id'] = $_POST['category_id'];
                $option['is_new'] = $_POST['is_new'];
                $option['is_recommended'] = $_POST['is_recommended'];
                $option['status'] = $_POST['status'];
                $option['image'] = "no-image";

                $result = Product::updateProductById($id, $option);
                if($result) {
                    header("Location: admin/product");
                }
            }

            $product = Product::getProductById($id);
            $categoriesList = Category::getCategoryList();
            include (ROOT."/views/admin_product/update.php");
            return true;
        }

        public function actionCreate() {

            self::checkAdmin();

            if($_POST['submit']) {
                $option['name'] = $_POST['name'];
                $option['code'] = $_POST['code'];
                $option['price'] = $_POST['price'];
                $option['category_id'] = $_POST['category_id'];
                $option['brand'] = $_POST['brand'];
                $option['description'] = $_POST['description'];
                $option['category_id'] = $_POST['category_id'];
                $option['availability'] = $_POST['availability'];
                $option['category_id'] = $_POST['category_id'];
                $option['is_new'] = $_POST['is_new'];
                $option['is_recommended'] = $_POST['is_recommended'];
                $option['status'] = $_POST['status'];
                $option['image'] = "no-image";

                $result = Product::createProduct($option);
                if($result) {
                    $lastId = Product::lastInsertProductId();
                    if($_FILES['image']) {
                        move_uploaded_file($_FILES['image']['tmp_name'], $_SERVER['DOCUMENT_ROOT'].'/upload/image/'.$lastId.'.jpg');
                    }
                    header("Location: admin/product");
                }
            }

            $categoriesList = Category::getCategoryList();
            include (ROOT."/views/admin_product/create.php");
            return true;
        }
    }