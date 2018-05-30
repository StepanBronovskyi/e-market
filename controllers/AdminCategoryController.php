<?php

    class AdminCategoryController extends AdminBasic {

        public function actionIndex() {

            self::checkAdmin();

            $categoriesList = Category::getCategoryList();

            include (ROOT."/views/admin_category/index.php");
            return true;
        }

        public function actionUpdate($id) {

            self::checkAdmin();

            if($_POST['submit']) {
                $category = array();
                $category['name'] = $_POST['name'];
                $category['sort_order'] = $_POST['sort_order'];
                $category['status'] = $_POST['status'];

                if(Category::updateCategory($id, $category)) {
                    header("Location: admin/category");
                }
            }

            $category = Category::getCategoryById($id);

            include (ROOT."/views/admin_category/update.php");
            return true;
        }

        public function actionDelete($id) {

            self::checkAdmin();

            if($_POST['submit']) {
                if(Category::deleteCategory($id) && Product::deleteProductsByCategoryId($id)) {
                    header("Location: admin/category");
                }
            }

            include (ROOT."/views/admin_category/delete.php");
            return true;
        }

        public function actionCreate() {

            self::checkAdmin();

            $name = "";
            $sort_order = "";
            $status = 0;

            if($_POST['submit']) {
                $name = $_POST['name'];
                $sort_order = $_POST['sort_order'];
                $status = $_POST['status'];

                if(Category::createCategory($name, $sort_order, $status)) {
                    header("Location: admin/category");
                }
            }

            include (ROOT."/views/admin_category/create.php");
            return true;
        }
    }