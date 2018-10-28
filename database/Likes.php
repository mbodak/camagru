<?php
require_once "DBInstance.php";

class Likes
{
    protected static $table = 'likes';

    /**
     * User like some image!
     * @return boolean, true - created, false - not created
     * @param number $userId - user who make like
     * @param number $imageId - image which would be liked
     */
    public static function add($userId, $imageId) {
        try {
            DBInstance::run("INSERT INTO {${self::$table}} VALUES (?, ?)", [$userId, $imageId]);
            return true;
        } catch (PDOException $e) {
            return false;
        }
    }

    /**
     * Check if image was liked by user!
     * @return boolean, true - was liked, false - was not liked
     * @param number $userId - user who made like
     * @param number $imageId - image which was liked
     */
    public static function isLiked($userId, $imageId) {
        try {
            $res = DBInstance::run("SELECT * FROM {${self::$table}} WHERE user_id = ? AND image_id = ?", [$userId, $imageId])->fetch();
            if (!empty($res)) {
                return true;
            }
            return false;
        } catch (PDOException $e) {
            return false;
        }
    }

    /**
     * Remove like!
     * @return boolean, true - removed, false - not removed
     * @param number $userId - user who made like
     * @param number $imageId - image which was liked
     */
    public static function remove($userId, $imageId) {
        try {
            DBInstance::run("DELETE FROM {${self::$table}} WHERE user_id = ? AND image_id = ?", [$userId, $imageId]);
            return true;
        } catch (PDOException $e) {
            return false;
        }
    }
}