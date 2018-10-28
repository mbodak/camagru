<?php

    include_once ROOT.'/models/camagruModel.php';

    class accountModel {
        public static function createAccount() {

            require_once (ROOT.'/views/create.php');
        }

        public static function login() {

            require_once (ROOT.'/views/login.php');
        }

        public static function logOut() {
            $_SESSION['logged_user'] = "";
            session_destroy();
            header("Location: http://localhost:8080/camagru");
        }

        public static function profile() {
            require_once (ROOT.'/views/profile.php');
        }

        public static function takePhoto() {
            require_once (ROOT.'/views/takePhoto.php');
        }

        public static function changePassword() {
            require_once (ROOT.'/views/forgot.php');
        }

        public static function activateAccount($login, $id) {
            header("Location: http://localhost:8080/camagru");
        }

        public static function notifications() {

        }

    }