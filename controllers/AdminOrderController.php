<?php

    class AdminOrderController extends AdminBasic {

        public function actionIndex() {

            self::checkAdmin();

            $ordersList = Order::getOrdersList();

            include (ROOT."/views/admin_order/index.php");
            return true;
        }

        public static function actionView($id) {

            self::checkAdmin();
            // список заказів
            $order = Order::getOrderById($id);
            // перевод строки у масив заказів типу {id - count, ...}
            $productsArray = json_decode($order['products'], true);
            // ідентифікатори замовлених товарів
            $productsIds = array_keys($productsArray);
            // список замовлених товарів
            $products = Product::getProdustsByIds($productsIds);

            include (ROOT."/views/admin_order/view.php");

            return true;
        }

        public static function actionDelete($id) {

            self::checkAdmin();

            if($_POST['submit']) {
                if(Order::deleteOrderById($id)) {
                    header("Location: admin/order");
                }
            }

            include (ROOT."/views/admin_order/delete.php");

            return true;
        }

        public static function actionUpdate($id) {

            self::checkAdmin();

            if($_POST['submit']) {

                $orderChanged = array();
                $orderChanged['user_name'] = $_POST['userName'];
                $orderChanged['user_phone'] = $_POST['userPhone'];
                $orderChanged['status'] = $_POST['status'];

                if(Order::updateOrder($id, $orderChanged)) {
                    header("Location: admin/order");
                }
            }

            $order = Order::getOrderById($id);

            include (ROOT."/views/admin_order/update.php");

            return true;
        }

    }