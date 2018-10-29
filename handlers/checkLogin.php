<?php
require_once __DIR__.'/../database/index.php';

if ($_POST && $_POST['login']) {
    print Users::isLoginOccupied($_POST['login']);
}