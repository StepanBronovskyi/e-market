<?php

    class CabinetController {

        public function actionIndex() {

            $userId = User::checkLogged();

            $user = User::getUserById($userId);

            include ROOT."/views/cabinet/index.php";

            return true;
        }

        public function actionEdit() {

            $userId = User::checkLogged();

            $user = User::getUserById($userId);
            $name = $user['name'];
            $password = $user['password'];

            $result = false;

            if(isset($_POST['submit'])) {
                $name = $_POST['name'];
                $password = $_POST['password'];

                $errors = false;
                if(!User::checkName($name)) {
                    $errors[] = "Закоротке ім'я";
                }
                if(!User::checkPassword($password)) {
                    $errors[] = "Закороткий пароль";
                }

                if(!$errors) {
                    $result = User::edit($userId, $name, $password);
                }
            }

            include ROOT."/views/cabinet/edit.php";
            return true;
        }

    }