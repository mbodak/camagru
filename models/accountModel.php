<?php
include_once ROOT.'/models/camagruModel.php';

class accountModel {
    public static function createAccount() {
        if ($_POST && isset($_POST['login']) && isset($_POST['email']) && isset($_POST['password'])) {
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
        if ($_POST && isset($_POST['email']) && isset($_POST['password'])) {
            $loginResult = Users::authorize($_POST['email'], $_POST['password']);
            if ($loginResult['result']) {
                $sessionCode = Randomizer::generateString();
                if (Sessions::add($loginResult['data'], $sessionCode)) {
                    $_SESSION['logged_user'] = $loginResult['data'];
                    $_SESSION['session_code'] = $sessionCode;
                    header("Location: ".LinkService::getRoot()."#loggedin");
                }
            } else {
                header("Location: ".LinkService::getRoot()."login#".$loginResult['message']);
            }
            exit();
        }
        require_once (ROOT.'/views/login.php');
    }

    public static function checkEmail($email) {
        return Users::isEmailOccupied($email);
    }

    public static function checkLogin($login) {
        return Users::isLoginOccupied($login);
    }

    public static function logOut() {\
        Sessions::remove(intval($_SESSION['logged_user']), $_SESSION['session_code']);
        $_SESSION['logged_user'] = "";
        $_SESSION['session_code'] = "";
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
        if ($_POST && isset($_POST['email'])) {
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
        if ($_POST && isset($_POST['password'])) {
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
        if ($_POST && isset($_POST['old_password']) && isset($_POST['new_password'])) {
            if (Users::changePassword(USER['login'], $_POST['old_password'], $_POST['new_password'])) {
                header("Location: ".LinkService::getRoot()."#changed");
            } else {
                header("Location: " . LinkService::getRoot() . "change#notChanged");
            }
            exit();
        }
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
        if (USER['notif_enabled']) {
            Users::turnOffNotifications(intval(USER['id']));
        } else {
            Users::turnOntNotifications(intval(USER['id']));
        }
    }

}