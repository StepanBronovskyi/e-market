<?php


    class ProductController {

        public function actionView($id) {
            $categoryList = Category::getCategoryList();
            $productItem = Product::getProductById($id);
            include (ROOT."/views/product/view.php");
            return true;
        }
    }