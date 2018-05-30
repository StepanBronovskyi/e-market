<?php

    class AdminController extends AdminBasic {

        public function actionIndex() {

            self::checkAdmin();

            include (ROOT."/views/admin/index.php");
            return true;
        }

    }