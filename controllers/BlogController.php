<?php


    class BlogController {

        public function actionIndex() {
            $blogsList = Blog::getBlogsList();
            include (ROOT."/views/blog/index.php");
            return true;
        }

        public function actionView($id) {
            $newsItem = Blog::getNewsById($id);
            include (ROOT."/views/blog/view.php");
            return true;
        }
    }