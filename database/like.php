<?php
require_once "DB.php";

function insertLike($photoID, $userID) {
    try {
        DB::run("INSERT INTO `likes` VALUES (?, ?)", [$userID, $photoID]);
    } catch (PDOException $e) {
        return false;
    }
    return true;
}

function selectIsLiked($photoID, $userID) {
    try {
        $sql = "SELECT * FROM `likes` WHERE id_user = :userid AND id_image = :imageid";
        $stmt = DB::instance()->prepare($sql);
        $stmt->bindValue(':userid', $userID, PDO::PARAM_STR);
        $stmt->bindValue(':imageid', $photoID, PDO::PARAM_STR);
        $stmt->execute();
        $res = $stmt->fetch();
        if (!empty($res)) {
            return true;
        }
        return false;
    } catch (PDOException $e) {
        return false;
    }
}

function deleteLike($photoID, $userID) {
    try {
        return DB::run("DELETE FROM `likes` WHERE id_user = ? AND id_image = ?", [$userID, $photoID]);
    } catch (PDOException $e) {
        return false;
    }
}