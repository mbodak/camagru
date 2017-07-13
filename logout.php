<?php
    session_start();
    setcookie("login", "", time());
    unset($_SESSION['']);
    unset($_SESSION['']);
    unset($_SESSION['']);
    header("Location: index.php");
?>