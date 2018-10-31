<?php

class camagruModel {
    public static function home() {
        require_once (ROOT.'/views/main.php');
    }

    public static function about() {
        require_once(ROOT . '/views/camagru.en.pdf');
    }
}