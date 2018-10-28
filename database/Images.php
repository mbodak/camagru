<?php
require_once "DBInstance.php";

class Images
{
    protected static $table = 'images';
    protected static $select = "SELECT
                                  `images`.id,
                                  `users`.login as `owner`,
                                  `images`.name,
                                  COALESCE( likes.quantity, 0 ) AS likes_count
                                FROM
                                  `users`,
                                  `images`
                                LEFT JOIN
                                  ( SELECT image_id, COUNT(*) AS quantity FROM `likes` GROUP BY id_image ) likes
                                  ON `images`.id = `likes`.image_id";
    /**
     * Create photo!
     * @param string $name - photo name in folder
     * @param number $userId - owner id
     * @return bool, true if created, false if not created
     */
    public static function add($name, $userId) {
        try {
            DBInstance::run("INSERT INTO {${self::$table}} VALUES (?, ?, ?)", [NULL, $name, $userId]);
            return true;
        } catch (PDOException $e) {
            return false;
        }
    }
    /**
     * Remove photo!
     * Only owner can!
     * @param number $id - photo id
     * @param number $userId - owner id
     * @return bool, true if removed, false if not removed
     */
    public static function remove($id, $userId) {
        try {
            $res = DBInstance::run("DELETE FROM `image` WHERE id = ? AND id_user = ?", [$id, $userId]);
            if ($res->rowCount()) {
                return true;
            }
            return false;
        } catch (PDOException $e) {
            return false;
        }
    }
    /**
     * Get all images with pagination!
     * @param number $skip - count element to skip
     * @param number $take - count to take element
     * @return array|PDOException
     */
    public static function getAll($skip, $take) {
        // TODO check binding
        try {
            $sql = "{${self::$select}}
                WHERE `users`.`id` = `images`.user_id
                ORDER BY `images`.id DESC
                LIMIT  :?, :?";
            return DBInstance::run($sql, [$skip, $take])->fetchAll();
        } catch (PDOException $e) {
            return $e;
        }
    }
    /**
     * @param number $id - id of image
     * @return mixed|PDOException
     */
    public static function getById($id) {
        try {
            $sql = "{${self::$select}}
                WHERE `images`.id = ?
                AND `users`.`id` = `images`.user_id";
            return DBInstance::run($sql, [$id])->fetch();
        } catch (PDOException $e) {
            return $e;
        }
    }
    /**
     * Get all images with pagination!
     * @param number $ownerId - image owner id
     * @param number $skip - count element to skip
     * @param number $take - count to take element
     * @return array|PDOException
     */
    public static function getAllByOwner($ownerId, $skip, $take) {
        try {
            $sql = "{${self::$select}}
                WHERE `images`.user_id = ?
                AND `users`.id = `images`.user_id
                ORDER BY `images`.id DESC
                LIMIT  ?, ?";

            return DBInstance::run($sql, [$ownerId, $skip, $take])->fetchAll();
        } catch (PDOException $e) {
            return $e;
        }
    }
}