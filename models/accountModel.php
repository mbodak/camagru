<?php
require_once ROOT.'/database/index.php';
require_once ROOT.'/services/Randomizer.php';
require_once ROOT.'/services/MailService.php';
require_once ROOT.'/services/LinkService.php';
include_once ROOT.'/models/camagruModel.php';

class accountModel {
    public static function createAccount() {
        if ($_POST &&  $_POST['login'] && $_POST['email'] && $_POST['password']) {
            $code = Randomizer::generateString();
            // TODO check email sending
            MailService::registerConfirmation($_POST['email'], $code);
            $registered = Users::add($_POST['email'], $_POST['login'], $_POST['password'], $code);
            if ($registered) {
                header("Location: ".LinkService::getRoot()."#registered");
            } else {
                header("Location: ".LinkService::getRoot()."#notRegistered");
            }
            exit();
        }
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

    public static function forgotPassword() {
        require_once (ROOT.'/views/forgot.php');
    }

    public static function recoverPassword() {
        require_once (ROOT.'/views/recover.php');
    }

    public static function changePassword() {
        require_once (ROOT.'/views/change.php');
    }

    public static function activateAccount() {
        header("Location: http://localhost:8080/camagru");
    }

    public static function notifications() {

    }

}