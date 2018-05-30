<?php

    class CatalogController {

        // перегляд усіх товарів
        // $page - номер сторінки
        public function actionIndex($page = 1) {
            // список товарів для певної сторінки
            $productsList = Product::getProductsList($page);
            // список категорії
            $categoryList = Category::getCategoryList();

            $count = Product::getCountProducts();
            // обєкт для посторінкової навігації
            $pagination = new Pagination($count, $page,6, 'page');

            // представлення (візуалізація)
            include(ROOT."/views/catalog/index.php");
            return true;
        }

        // перегляд товарів певної категоріїї
        // $page - номер сторінки
        public function actionView($category_id, $page = 1) {
            // список товарів для певної категорії і сторінки
            $productsList = Product::getProductsByCategoryId($category_id, $page);
            $categoryList = Category::getCategoryList();

            $count = Product::getCountProductsInCategory($category_id);
            // обєкт для посторінкової навігації
            $pagination = new Pagination($count, $page, 6, 'page');
            // представлення (візуалізація)
            include (ROOT."/views/catalog/category.php");
            return true;
        }
    }