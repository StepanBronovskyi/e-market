<?php

    class Card {

        public static function addProduct($id) {
            $productInCard = array();
            if(isset($_SESSION['products'])) {
                $productInCard = $_SESSION['products'];
            }

            if(array_key_exists($id, $productInCard)) {
                $productInCard[$id] ++;
            }
            else {
                $productInCard[$id] = 1;
            }
            $_SESSION['products'] = $productInCard;
            return self::countProductsInCard();
        }

        public static function countProductsInCard() {
            if(isset($_SESSION['products'])) {
                $count = 0;
                $list = $_SESSION['products'];
                foreach ($list as $item => $number) {
                    $count = $count + $number;
                }
                return $count;
            }
            else {
                return 0;
            }
        }

        public static function getProducts() {
            if(isset($_SESSION['products'])) {
                return $_SESSION['products'];
            }
            return false;
        }

        public static function getTotalPrice($products) {
            $price = 0;
            $productsInCard = self::getProducts();

            foreach ($products as $product) {
                $price += $product['price'] * $productsInCard[$product['id']];
            }
            return $price;
        }


        public static function getTotalQuantity() {
            $productInCard = self::getProducts();
            $count = 0;
            foreach ($productInCard as $product => $amount) {
                $count += $amount;
            }
            return $count;
        }

        public static function deleteItemFromCard($id) {
            $productsInCard = $_SESSION['products'];
            unset($productsInCard[$id]);
            $_SESSION['products'] = $productsInCard;
            return true;
        }

        public static function clear() {
            if(isset($_SESSION['products'])) {
                unset($_SESSION['products']);
            }
        }
    }