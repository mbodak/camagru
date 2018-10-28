<?php
require_once "DBInstance.php";

class Users
{
    protected static $table = 'users';

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
     * Register user!
     * @return boolean, true if user was created and false if some error was happened!
     * @param string $email - email
     * @param string $login - login
     * @param string $login - login
     * @param string $passwd - password
     * @param string $activationCode - activation code that was sent to email
     */
    public static function add($email, $login, $passwd, $activationCode) {
        $password = hash('sha256', $passwd);
        try {
            DBInstance::run("INSERT INTO {${self::$table}} VALUES (?, ?, ?, ?, ?, ?, ?)", [NULL, $email, $login, $password, 0 /* IS ACTIVATED */, $activationCode, 1 /* NOTIFICATION ENABLED */]);
        } catch (PDOException $e) {
            return false;
        }
        return true;
    }
    /**
     * Activate user's account after registration! Confirm email!
     * @return boolean, true - activated, false - doesn't activated
     * @param number $id - id of user to activation
     * @param string $activationCode - activation code that was sent to email of user
     */
    public static function activateUser($id, $activationCode) {
        try {
            $res = DBInstance::run("SELECT `id` FROM {${self::$table}} WHERE `id` = ? AND `code` = ? AND `is_activated` = ?", [$id, $activationCode, 0])->fetch();
            if ($res['id']) {
                $stmt = DBInstance::run("UPDATE {${self::$table}} SET `code` = ?, `is_activated` = ? WHERE `id` = ?", ["0", 1, $res['id']]);
                if ($stmt->rowCount() > 0)
                    return true;
            }
            return false;
        } catch (PDOException $e) {
            return false;
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
            $stmt = DBInstance::run("SELECT `id`, `is_activated` FROM {${self::$table}} WHERE `passwd` = ? AND (`email` = ? OR `login` = ?)", [$password, $login, $login]);
            if ($stmt->rowCount() <= 0)
                return ["result" => false, "message" => 'User not found or password is wrong'];
            $result = $stmt->fetch();
            if ($result['is_activated'] == 0)
                return ["result" => false, "message" => 'User does not activated'];
            return ["result" => true, "message" => 'Successful login', "data" => $result['id']];
        } catch (PDOException $e) {
            return ["result" => false, "message" => 'Some unexpected error'];
        }
    }
    /**
     * Get user's login, email, id and info about notifications, to show on profile page! Return only activated users!
     * @return array ['id' => number, 'login' => string, 'email' => string, 'notif_enabled' => number (1 or 0)]
     * @param number $id - id of user
     */
    public static function getUserInfo($id) {
        try {
            $res = DBInstance::run("SELECT `id`, `login`, `email`, `notif_enabled` FROM {${self::$table}} WHERE `id` = ? AND `is_activated` = ?", [$id, 1])->fetch();
            return $res;
        } catch (PDOException $e) {
            return null;
        }
    }
    /**
     * Initialize restoring password process!
     * @return array ['result' => boolean, 'message' => string, 'data' => number]
     *  result - true if initialization succeed
     *  message - reason of initialization problem, or message with email
     * @param string $loginOrEmail - login or email user that will be restored pass
     * @param string $activationCode - activation code that was sent to email of user
     */
    public static function restorePasswordInit($loginOrEmail, $activationCode) {
        try {
            $stmt = DBInstance::run("SELECT `id`, `email` FROM {${self::$table}} WHERE `is_activated` = ? AND (`email` = ? OR `login` = ?)", [1, $loginOrEmail, $loginOrEmail]);
            if ($stmt->rowCount() <= 0)
                return ["result" => false, "message" => 'User not found!'];
            $result = $stmt->fetch();
            DBInstance::run("UPDATE {${self::$table}} SET `code` = ? WHERE `id` = ?", [$activationCode, $result['id']]);
            return ["result" => true, "message" => "Message sent to ${$result['email']}"];
        } catch (PDOException $e) {
            return ["result" => false, "message" => 'Some error has occurred!'];
        }
    }
    /**
     * Confirm restoring password process!
     * @return array ['result' => boolean, 'message' => string, 'data' => number]
     *  result - true if initialization succeed
     *  message - reason of initialization problem, or message with email
     * @param string $activationCode - activation code that was sent to email of user
     * @param string $passwd - new user's password
     */
    public static function restorePasswordConfirm($activationCode, $passwd) {
        try {
            $stmt = DBInstance::run("SELECT `id` FROM {${self::$table}} WHERE `is_activated` = ? AND `code` = ?", [1, $activationCode]);
            if ($stmt->rowCount() <= 0)
                return ["result" => false, "message" => 'User not found!'];
            $result = $stmt->fetch();
            DBInstance::run("UPDATE {${self::$table}} SET `code` = ?, `password` = ? WHERE `id` = ?", ["1", hash('sha256', $passwd), $result['id']]);
            return ["result" => true, "message" => 'User`s password was changed!!'];
        } catch (PDOException $e) {
            return ["result" => false, "message" => 'Some error has occurred!'];
        }
    }
    /**
     * Change password using login and old password!
     * @return boolean, true - pass was changed, false - was not changed
     * @param string $login - login to check
     * @param string $oldPassword - old password
     * @param string $newPassword - new password
     */
    public static function changePassword($login, $oldPassword, $newPassword) {
        $oldPass = hash('sha256', $oldPassword);
        $newPass = hash('sha256', $newPassword);
        try {
            $res = DBInstance::run("SELECT `id` FROM {${self::$table}} WHERE `login` = ? AND `passwd` = ?", [$login, $oldPass])->fetch();
            if ($res['id']) {
                $stmt = DBInstance::run("UPDATE {${self::$table}} SET `passwd` = ? WHERE `id` = ?", [$newPass, $res['id']]);
                if ($stmt->rowCount() > 0)
                    return true;
            }
            return false;
        } catch (PDOException $e) {
            return false;
        }
    }
    /**
     * Turn on notifications to user!
     * @return boolean, true - notifications was turned on, false - was no changes
     * @param number $id - id of user
     */
    public static function turnOntNotifications($id) {
        try {
            $stmt = DBInstance::run("UPDATE {${self::$table}} SET `notif_enabled` = ? WHERE `id` = ?", [1, $id]);
            if ($stmt->rowCount() > 0)
                return true;
            return false;
        } catch (PDOException $e) {
            return false;
        }
    }
    /**
     * Turn off notifications to user!
     * @return boolean, true - notifications was turned off, false - was no changes
     * @param number $id - id of user
     */
    public static function turnOffNotifications($id) {
        try {
            $stmt = DBInstance::run("UPDATE {${self::$table}} SET `notif_enabled` = ? WHERE `id` = ?", [0, $id]);
            if ($stmt->rowCount() > 0)
                return true;
            return false;
        } catch (PDOException $e) {
            return false;
        }
    }
}