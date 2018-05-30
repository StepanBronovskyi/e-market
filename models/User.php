<?php

    class User {

        public static function register($name, $email, $password) {
            $db = Db::getConnection();
            $query = "INSERT INTO users (name, password, email) VALUES ('$name', '$password', '$email')";
            $result = $db->query($query);
            return $result;
        }

        public static function edit($id, $name, $password) {
            $db = Db::getConnection();
            $query = "UPDATE users SET name = '$name', password = '$password' WHERE id = '$id'";
            $result = $db->query($query);
            return $result;
        }

        public static function checkName($name) {
            if(strlen($name) > 2 && strlen($name) < 30) {
                return true;
            }
            return false;
        }

        public static function checkPassword($password) {
            if(strlen($password) > 6) {
                return true;
            }
            return false;
        }

        public static function checkPhone($phone) {
            if(strlen($phone) > 9 && strlen($phone) < 15) {
                return true;
            }
            return false;
        }

        public static function checkEmail($email) {
            if(filter_var($email, FILTER_VALIDATE_EMAIL)){
                return true;
            }
            return false;
        }

        public static function checkEmailExist($email) {
            $db = Db::getConnection();
            $query = "SELECT * FROM users WHERE email = '$email'";
            $result = $db->query($query);
            if(!$result->num_rows) {
                return true;
            }
            return false;
        }

        public static function checkUserData($email, $password) {
            $db = Db::getConnection();
            $query = "SELECT * FROM users WHERE email = '$email' AND password = '$password'";
            $result = $db->query($query);

            if($result) {
                $result->data_seek(0);
                $row = $result->fetch_array(MYSQLI_ASSOC);
                return $row['id'];
            }

            return false;
        }

        public static function auth($userId) {
            $_SESSION['user'] = $userId;
        }

        public static function checkLogged() {
            if(isset($_SESSION['user'])) {
                return $_SESSION['user'];
            }
            header("Location: /user/login/");
        }

        public static function isGuest() {
            if(isset($_SESSION['user'])) {
                return false;
            }
            return true;
        }

        public static function getUserId() {
            if(isset($_SESSION['user'])) {
                return $_SESSION['user'];
            }
            return false;
        }

        public static function getUserById($id) {
            $db = Db::getConnection();
            $query = "SELECT * FROM users WHERE id='$id'";
            $result = $db->query($query);

            $user = array();
            if($result) {
                $result->data_seek(0);
                $user = $result->fetch_array(MYSQLI_ASSOC);
                return $user;
            }
            return $user;
        }
    }