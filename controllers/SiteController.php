<?php


    class SiteController {

        public function actionIndex() {
            $categoryList = array();
            $productsList = array();
            $categoryList = Category::getCategoryList();
            $productsList = Product::getProductsList();
            $sliderProducts = Product::getRecomendedProducts();
            include (ROOT."/views/site/index.php");
            return true;
        }

        public function actionContacts() {

            $userEmail = '';
            $message = '';
            $subject = '';

            if($_POST['submit']) {

                $userEmail = $_POST['email'];
                $message = $_POST['text'];


                $errors = false;

                if(!User::checkEmail($userEmail)) {
                    $errors[] = "Wrong email";
                }

                $result = false;

                if(!$errors) {
                    $adminEmail = 'bronovskyi74@gmail.com';
                    $message = "{$message} from {$userEmail}";
                    $subject = "????????? && ??????????";

                    mail($adminEmail, $subject, $message);
                    $result = true;
                }
            }

            include (ROOT."/views/site/contacts.php");
            return true;
        }
    }