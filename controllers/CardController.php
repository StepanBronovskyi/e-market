<?php

    class CardController {

        public function actionAdd($id) {
            $count = Card::addProduct($id);
            $lastUri = $_SERVER['HTTP_REFERER'];
            header("Location: $lastUri");
            return true;
        }

        public function actionAddAjax($id) {
            $count = Card::addProduct($id);
            echo $count;
            return true;
        }

        public function actionIndex() {

            $productsInCard = Card::getProducts();
            if($productsInCard) {
                $productsIds = array_keys($productsInCard);
                $products = Product::getProdustsByIds($productsIds);

                $totalPrice = Card::getTotalPrice($products);
            }

            include (ROOT."/views/card/index.php");
            return true;
        }

        public function actionDelete($id) {
            Card::deleteItemFromCard($id);
            $lastUri = $_SERVER['HTTP_REFERER'];
            header("Location: $lastUri");
            return true;
        }

        public function actionCheckout() {

            $userName = "";
            $userId = "";

            if(!User::isGuest()) {
                $userId = User::getUserId();
                $user = User::getUserById($userId);
                $userName = $user['name'];
            }
            $userPhone = "";
            $userComment = "";

            if($_POST['submit']) {

                $productsInCard = Card::getProducts();
                $productsIds = array_keys($productsInCard);
                $products = Product::getProdustsByIds($productsIds);

                $userName = $_POST['userName'];
                $userPhone = $_POST['userPhone'];
                $userComment = $_POST['userComment'];

                $errors = false;

                if(!User::checkName($userName)) {
                    $errors[] = "Закоротке ім'я";
                }
                if(!User::checkPhone($userPhone)) {
                    $errors[] = "Закороткий номер";
                }

                $result = false;

                if(!$errors) {
                    $result = Order::save($userName, $userPhone, $userId, $productsInCard);

                    mail('admin_mail', 'New order', 'myshop/admin/orders');

                    Card::clear();
                }
                if(!$result) {
                    //$totalPrice = Card::getTotalPrice($products);
                    //$totalQuantity = Card::getTotalQuantity();
                }
            }
            else {
                if(Card::countProductsInCard() == 0) {
                    header("Location: /");
                }
            }

            include (ROOT."/views/card/checkout.php");
            return true;
        }
    }