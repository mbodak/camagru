<?php
    //1 Configuration
    ini_set('display_errors','on');
    error_reporting(E_ALL);
    session_start();

    //2 Connect files
    define('ROOT', dirname(__FILE__));
    require_once(ROOT.'/components/Router.php');

    if (!isset($_SESSION['logged_user'])) {
        $_SESSION['logged_user'] = "";
    }
    if (!isset($_SESSION['error'])) {
        $_SESSION['error'] = "";
    }
    if (!isset($_SESSION['activation'])) {
        $_SESSION['activation'] = "";
    }

    //4 Calling Router
    $router = new Router();
    $router->runRouter();

