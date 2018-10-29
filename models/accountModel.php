<?php
require_once ROOT.'/database/index.php';
require_once ROOT.'/services/Randomizer.php';
require_once ROOT.'/services/MailService.php';
require_once ROOT.'/services/LinkService.php';
include_once ROOT.'/models/camagruModel.php';

class accountModel {
    public static function createAccount() {
        if ($_POST && $_POST['login'] && $_POST['email'] && $_POST['password']) {
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
        if ($_POST && $_POST['email']) {
            $code = Randomizer::generateString();
            $sent = Users::restorePasswordInit($_POST['email'], $code);
            if ($sent) {
                MailService::restorePasswordConfirmation($_POST['email'], $code);
                header("Location: ".LinkService::getRoot()."#forgotSent");
            } else {
                header("Location: ".LinkService::getRoot()."#forgotNotSent");
            }
            exit();
        }
        require_once (ROOT.'/views/forgot.php');
    }

    public static function recoverPassword() {
        if ($_POST && $_POST['password']) {
            $queries = array();
            parse_str($_SERVER['QUERY_STRING'], $queries);
            if ($queries['code'] && Users::restorePasswordConfirm($queries['code'], $_POST['password'])) {
                header("Location: ".LinkService::getRoot()."#recovered");
            } else {
                header("Location: " . LinkService::getRoot() . "#notRecovered");
            }
            exit();
        }

        require_once (ROOT.'/views/recover.php');
    }

    public static function changePassword() {
        require_once (ROOT.'/views/change.php');
    }

    public static function activateAccount() {
        $queries = array();
        parse_str($_SERVER['QUERY_STRING'], $queries);
        if (Users::activateUser($queries['code'])) {
            header("Location: ".LinkService::getRoot()."#activated");
        } else {
            header("Location: " . LinkService::getRoot() . "#notActivated");
        }
    }

    public static function notifications() {

    }

}