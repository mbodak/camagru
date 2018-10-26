<?php
require_once "DBInstance.php";

class Users
{
    protected static $table = 'users';

    /**
     * Register user!
     * @return boolean, true if user was created and false if some error was happened!
     * @param string $email - email
     * @param string $login - login
     * @param string $login - login
     * @param string $passwd - password
     * @param string $activation_code - activation code that was sent to email
     */
    public static function add($email, $login, $passwd, $activation_code) {
        $password = hash('sha256', $passwd);
        try {
            DBInstance::run("INSERT INTO {${self::$table}} VALUES (?, ?, ?, ?, ?, ?, ?)", [NULL, $email, $login, $password, 0 /* IS ACTIVATED */, $activation_code, 1 /* NOTIFICATION ENABLED */]);
        } catch (PDOException $e) {
            return false;
        }
        return true;
    }
    /**
     * Get user login, to show on main page! Return only activated users!
     * @return string (user's login) or empty string if users doesn't exist
     * @param number $id - id of user
     */
    public static function getUserLogin($id) {
        try {
            $login = DBInstance::run("SELECT `login` FROM {${self::$table}} WHERE `id` = ? AND `activated` = ?", [$id, 1])->fetch()['login'];
            return $login;
        } catch (PDOException $e) {
            return 0;
        }
    }
    /**
     * Get user id, using login. Return only activated users!
     * @return number (user's id)
     * @param string $login - login of user
     */
    public static function getUserId($login) {
        try {
            $id = DBInstance::run("SELECT `id` FROM {${self::$table}} WHERE `login` = ? AND `activated` = ?", [$login, 1])->fetch()['id'];
            return $id;
        } catch (PDOException $e) {
            return -1;
        }
    }
    /**
     * Try to authorize user. Check login and password!
     * @return array ['result' => boolean, 'message' => string, 'data' => number]
     *  result - true if login success and false login problem.
     *  message - reason of login problem
     *  data - users id, only if login was success
     * @param string $login - login of user
     * @param string $passwd - password of user
     */
    public static function authorize($login, $passwd) {
        $password = hash('sha256', $passwd);
        try {
            $stmt = DBInstance::run("SELECT `id`, `activated` FROM {${self::$table}} WHERE `password` = ? AND (`email` = ? OR `login` = ?)", [$password, $login, $login]);
            $stmt->rowCount();
            if ($stmt->rowCount() <= 0)
                return ["result" => false, "message" => 'user not found or password is wrong'];
            $result = $stmt->fetch();
            if ($result['activated'] == 0)
                return ["result" => false, "message" => 'user does not activated'];
            return ["result" => true, "message" => 'successful', "data" => $result['id']];
        } catch (PDOException $e) {
            return ["result" => false, "message" => 'some error'];
        }
    }

    /**
     * Check if login is occupied
     * @return boolean, true - occupied, false - not occupied
     * @param string $login - login to check
     */
    public static function isLoginOccupied($login) {
        try {
            $id = DBInstance::run("SELECT `id` FROM {${self::$table}} WHERE `login` = ?", [$login])->fetch();
            if ($id) {
                return true;
            }
            return false;
        } catch (PDOException $e) {
            return false;
        }
    }

    /**
     * Check if email is occupied
     * @return boolean, true - occupied, false - not occupied
     * @param string $email - email to check
     */
    public static function isEmailOccupied($email) {
        try {
            $id = DBInstance::run("SELECT `id` FROM {${self::$table}} WHERE `email` = ?", [$email])->fetch();
            if ($id) {
                return true;
            }
            return false;
        } catch (PDOException $e) {
            return false;
        }
    }

    /**
     * Change password only if old password was correct!
     * @return boolean, true - occupied, false - not occupied
     * @param string $email - email to check
     * @param string $oldPassword - old password
     * @param string $newPassword - new password
     */
    public static function changePassword($email, $oldPassword, $newPassword) {
        $oldPass = hash('sha256', $oldPassword);
        $newPass = hash('sha256', $newPassword);
        try {
            $id = DBInstance::run("SELECT `id` FROM {${self::$table}} WHERE `email` = ? AND `password` = ?", [$email, $oldPass])->fetch();
            $stmt = DBInstance::run("UPDATE `user` SET `password` = ? WHERE `id` = ?", [$newPass, $id]);
            if ($stmt->rowCount() > 0)
                return true;
        } catch (PDOException $e) {
            return false;
        }
        return false;
    }
    public static function activateUser($code) {
        try {
            $id = DBInstance::run("SELECT `id` FROM {${self::$table}} WHERE `code` = ? AND `activated` = ?", [$code, 0])->fetch()['id'];
            if ($id) {
                $stmt = DBInstance::run("UPDATE `user` SET `activation_code` = ?, `activated` = ? WHERE `id` = ?", ["empty", 1, $id]);
                if ($stmt->rowCount() > 0)
                    return true;
                return $id;
            }
            return "ac";
        } catch (PDOException $e) {
            return "ad";
        }
    }
}