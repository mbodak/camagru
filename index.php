<?php

//1 Configuration
ini_set('display_errors','on');
error_reporting(E_ALL);
session_start();

//2 Connect files
define('ROOT', dirname(__FILE__));
require_once(ROOT.'/components/Router.php');
require_once ROOT.'/database/index.php';
require_once ROOT.'/database/Images.php';

// 3 SESSION WORKFLOW
if (!isset($_SESSION['logged_user'])) {
    $_SESSION['logged_user'] = "";
}
if (!isset($_SESSION['session_code'])) {
    $_SESSION['session_code'] = "";
}

if ($_SESSION['logged_user'] !== "" && $_SESSION['session_code'] !== "" && Sessions::isExist(intval($_SESSION['logged_user']), $_SESSION['session_code'])) {
    define('USER', Users::getUserInfo(intval($_SESSION['logged_user'])));
    define('LOGGED_IN', true);
} else {
    define('USER', null);
    define('LOGGED_IN', false);
}

//4 Calling Router
$router = new Router();
$router->runRouter();

