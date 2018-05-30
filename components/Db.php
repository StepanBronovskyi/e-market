<?php
    class Db {
        public static function getConnection() {
            $params = include (ROOT."/config/db_params.php");
            $db = new mysqli($params['host'], $params['user'], $params['password'], $params['dbname']);
            return $db;
        }
    }