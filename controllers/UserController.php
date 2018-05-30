<?php

    class UserController {

        public function actionRegister() {
            $name = '';
            $email = '';
            $password = '';

            if(isset($_POST['submit'])) {
                $name = $_POST['name'];
                $email = $_POST['email'];
                $password = $_POST['password'];
            }

            $result = false;
            $errors = false;

            if(!User::checkName($name)) {
                $errors[] = "Неправильне ім'я";
            }
            if(!User::checkPassword($password)) {
                $errors[] = "Закороткий пароль";
            }
            if(!User::checkEmail($email)) {
                $errors[] = "Невірний e-mail";
            }
            if(!User::checkEmailExist($email)) {
                $errors[] = "Даний e-mail уже зареєстрований";
            }
            if(!$errors) {
                $result = User::register($name, $email ,$password);
            }

            include (ROOT."/views/user/register.php");
            return true;
        }

        public function actionLogin() {

            $email = "";
            $password = "";

            if($_POST['submit']) {
                $email = $_POST['email'];
                $password = $_POST['password'];
            }

            $errors = false;

            if(!User::checkEmail($email)) {
                $errors[] = "Невірний e-mail";
            }
            if(!User::checkPassword($password)) {
                $errors[] = "Закороткий пароль";
            }

            $userId = User::checkUserData($email, $password);

            if(!$userId) {
                $errors[] = "Неправильні дані";
            }
            else {
                User::auth($userId);
                header("Location: /cabinet/");
            }

            include (ROOT."/views/user/login.php");
            return true;
        }

        public function actionLogout() {
            unset($_SESSION['user']);
            unset($_SESSION['admin']);
            header("Location: /");
            return true;
        }
    }