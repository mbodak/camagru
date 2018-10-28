<?php
require_once "DBInstance.php";

class Sessions
{
    protected static $table = 'sessions';

    /**
     * Create session for user!
     * @return boolean, true - created, false - not created
     * @param number $userID - user's id for whom session will be created
     * @param string $sessionCode - session unique code, which will be saved at user's cookie
     */
    public static function add($userID, $sessionCode) {
        try {
            DBInstance::run("INSERT INTO {${self::$table}} VALUES (?, ?, ?)", [null, $userID, $sessionCode]);
            return true;
        } catch (PDOException $e) {
            return false;
        }
    }
    /**
     * Remove session for user!
     * @return boolean, true - removed, false - not removed
     * @param number $userID - user's id for whom session will be created
     * @param string $sessionCode - session unique code, which will be saved at user's cookie
     */
    public static function remove($userID, $sessionCode) {
        try {
            DBInstance::run("DELETE FROM {${self::$table}} WHERE `user_id` = ? AND `session_code` = ?", [$userID, $sessionCode]);
            return true;
        } catch (PDOException $e) {
            return false;
        }
    }
    /**
     * Check if session exist! User already logged in or not!
     * @return boolean, true - logged in, false - not logged in
     * @param number $userID - user's id which will checked
     * @param string $sessionCode - session unique code, which was saved at user's cookie
     */
    public static function isExist($userID, $sessionCode) {
        try {
            $id = DBInstance::run("SELECT `id` FROM {${self::$table}} WHERE `user_id` = ? AND `session_code` = ?", [$userID, $sessionCode])->fetch()['id'];
            if ($id) {
                return true;
            }
            return false;
        } catch (PDOException $e) {
            return false;
        }
    }
}