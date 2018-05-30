<?php

    class Order {

        public static function save($userName, $userPhone, $userId = 0, $productsInCard) {

            $db = Db::getConnection();
            $products = json_encode($productsInCard);
            $query = "INSERT INTO orders (user_name, user_phone, user_id, products, status)"
                . "VALUES ('$userName', '$userPhone', '$userId', '$products', '1')";

            $result = $db->query($query);

            return $result;
        }

        public static function getOrdersList() {

            $db = Db::getConnection();

            $query = "SELECT * FROM orders ORDER BY id DESC";

            $result = $db->query($query);
            $num = $result->num_rows;

            $ordersList = array();

            for($i = 0; $i < $num; ++$i) {
                $result->data_seek($i);
                $row = $result->fetch_array(MYSQLI_ASSOC);

                $ordersList[$i]['id'] = $row['id'];
                $ordersList[$i]['user_name'] = $row['user_name'];
                $ordersList[$i]['user_phone'] = $row['user_phone'];
                $ordersList[$i]['date'] = $row['date'];
                $ordersList[$i]['status'] = $row['status'];
            }

            return $ordersList;
        }

        public static function getOrderById($id) {

            $db = Db::getConnection();

            $query = "SELECT * FROM orders WHERE id = '$id'";

            $result = $db->query($query);
            $result->data_seek(0);

            $order = $result->fetch_array(MYSQLI_ASSOC);

            return $order;
        }

        public static function deleteOrderById($id) {

            $db = Db::getConnection();

            $query = "DELETE FROM orders WHERE id = '$id'";

            $result = $db->query($query);

            return $result;
        }

        public static function updateOrder($id, $order) {

            $db = Db::getConnection();

            $query = "UPDATE orders SET user_name = '$order[user_name]', user_phone = '$order[user_phone]',"
            ."status = '$order[status]' WHERE id = '$id'";

            $result = $db->query($query);

            return $result;
        }

        public static function getStatusText($status) {

            if($status == 1) {
                return "Новый заказ";
            }
            if($status == 2) {
                return "В обработке";
            }
            if($status == 3) {
                return "Доставляется";
            }
            if($status == 4) {
                return "Закрыт";
            }
        }
    }