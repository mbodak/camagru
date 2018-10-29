<?php

class Randomizer
{
    public static function generateString($length = 12) {
        $FROM = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
        $result = '';
        for ($i = 0; $i < $length; $i++) {
            $rand = self::generateNumber(0, strlen($FROM) - 1);
            $result .= $FROM[$rand];
        }
        return $result;
    }
    public static function generateNumber($min, $max) {
        return rand($min, $max);
    }
}