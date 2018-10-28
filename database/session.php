<?php
require_once "DB.php";

function insertSession($userID, $sessionID) {
    try {
        DB::run("INSERT INTO `session` VALUES (?, ?, ?)", [null, $userID, $sessionID]);
        return true;
    } catch (PDOException $e) {
        return $e;
    }
}

function selectSession($user, $sessionID) {
    $userID = getUserId($user);
    try {
        $id = DB::run("SELECT `id` FROM `session` WHERE `userID` = ? AND `sessionID` = ?", [$userID, $sessionID])->fetch()['id'];
        if ($id) {
            return $userID;
        }
        return $id;
    } catch (PDOException $e) {
        return false;
    }
}