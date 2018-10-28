<?php

require_once __DIR__.'/../config/database.php';

class DBInstance
{
    protected static $instance = null;

    public function __construct() {}

    public static function instance()
    {
        if (self::$instance !== null)
        {
            return self::$instance;
        }
        self::$instance = new PDO(DATABASE_CONNECTION_STRING, DATABASE_USER, DATABASE_PASSWORD, DATABASE_OPT);
        return self::$instance;
    }

    public static function run($sql, $args = [])
    {
        $stmt = self::instance()->prepare($sql);
        $stmt->execute($args);
        return $stmt;
    }
}