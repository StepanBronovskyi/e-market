<?php

    abstract class AdminBasic {

        public static function checkAdmin() {

            $userId = User::checkLogged();

            $user = User::getUserById($userId);
            if($user['role']) {
                return true;
            }
            die('Access denied');
        }
    }