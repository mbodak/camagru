<?php
require_once "DBInstance.php";

function activateUser($code) {
    try {
        $id = DBInstance::run("SELECT `id` FROM `user` WHERE `activation_code` = ? AND `activated` = ?", [$code, 0])->fetch()['id'];
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

function restorePassPhase1($user, $code) {
    try {
        $stmt = DBInstance::run("SELECT `id`, `email` FROM `user` WHERE `activated` = ? AND (`email` = ? OR `login` = ?)", [1, $user, $user]);
        $stmt->rowCount();
        if ($stmt->rowCount() <= 0)
            return false;
        $result = $stmt->fetch();
        $stmt = DBInstance::run("UPDATE `user` SET `activation_code` = ? WHERE `id` = ?", [$code, $result['id']]);
        if ($stmt->rowCount() <= 0)
            return false;
        return $result['email'];
    } catch (PDOException $e) {
        return false;
    }
}

function restorePassPhase2($user, $code, $pass) {
    try {
        $stmt = DBInstance::run("SELECT `id` FROM `user` WHERE `activated` = ? AND `email` = ? AND `activation_code` = ?", [1, $user, $code]);
        $stmt->rowCount();
        if ($stmt->rowCount() <= 0)
            return "user not found";
        $result = $stmt->fetch();
        $stmt = DBInstance::run("UPDATE `user` SET `activation_code` = ?, `password` = ? WHERE `id` = ?", ["1", hash('sha256', $pass), $result['id']]);
        if ($stmt->rowCount() <= 0)
            return "user not updated";
        return true;
    } catch (PDOException $e) {
        return $e;
    }
}


