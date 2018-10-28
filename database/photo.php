<?php
require_once "DB.php";
function insertPhoto($photoName, $authorID) {
    try {
        DB::run("INSERT INTO `image` VALUES (?, ?, ?)", [NULL, $authorID, $photoName]);
    } catch (PDOException $e) {
        return false;
    }
    return true;
}

function selectPhotoOwner($id) {
    try {
        $sql = "SELECT `id_user`, `name` FROM `image` WHERE id = :id";
        $stmt = DB::instance()->prepare($sql);
        $stmt->bindValue(':id', $id, PDO::PARAM_STR);
        $stmt->execute();
        $res = $stmt->fetch();
        return $res;
    } catch (PDOException $e) {
        print $e;
        return null;
    }
}

function deletePhoto($id, $userID) {
    try {
        return DB::run("DELETE FROM `image` WHERE id = ? AND id_user = ?", [$id, $userID]);
    } catch (PDOException $e) {
        print $e;
        return false;
    }
}

function selectUserPhotoList($authorID, $first, $last) {
    try {
        $sql = "SELECT image.id, `user`.login as `user`, image.name,
                  COALESCE( l.cnt, 0 ) AS likeCount,
                  COALESCE( c.cnt, 0 ) AS chatCount
                FROM `user`, image
                  LEFT JOIN
                  ( SELECT id_image, COUNT(*) AS cnt
                    FROM likes
                    GROUP BY id_image ) l
                    ON image.id = l.id_image
                  LEFT JOIN
                  ( SELECT id_image, COUNT(*) AS cnt
                    FROM comment
                  GROUP BY id_image ) c
                    ON image.id = c.id_image
                WHERE image.id_user = :id 
                AND `user`.`id` = `image`.id_user
                ORDER BY image.id DESC
                LIMIT  :first, :max";

        $stmt = DB::instance()->prepare($sql);
        $stmt->bindValue(':id', $authorID, PDO::PARAM_STR);
        $stmt->bindValue(':first', intval($first), PDO::PARAM_INT);
        $stmt->bindValue(':max', intval($last) - intval($first), PDO::PARAM_INT);
        $stmt->execute();
        $res = $stmt->fetchAll();
        return $res;
    } catch (PDOException $e) {
        return $e;
    }
}

function selectPhotoList($first, $last) {
    try {
        $sql = "SELECT image.id, `user`.login as `user`, image.name,
                  COALESCE( l.cnt, 0 ) AS likeCount,
                  COALESCE( c.cnt, 0 ) AS chatCount
                FROM `user`, image
                  LEFT JOIN
                  ( SELECT id_image, COUNT(*) AS cnt
                    FROM likes
                    GROUP BY id_image ) l
                    ON image.id = l.id_image
                  LEFT JOIN
                  ( SELECT id_image, COUNT(*) AS cnt
                    FROM comment
                  GROUP BY id_image ) c
                    ON image.id = c.id_image
                WHERE `user`.`id` = `image`.id_user
                ORDER BY image.id DESC
                LIMIT  :first, :max";
        $stmt = DB::instance()->prepare($sql);
        $stmt->bindValue(':first', intval($first), PDO::PARAM_INT);
        $stmt->bindValue(':max', intval($last) - intval($first), PDO::PARAM_INT);
        $stmt->execute();
        $res = $stmt->fetchAll();
        return $res;
    } catch (PDOException $e) {
        return $e;
    }
}

function selectPhotoByID($id) {
    try {
        $sql = "SELECT image.id, `user`.login as `user`, image.name,
                  COALESCE( l.cnt, 0 ) AS likeCount,
                  COALESCE( c.cnt, 0 ) AS chatCount
                FROM `user`, image
                  LEFT JOIN
                  ( SELECT id_image, COUNT(*) AS cnt
                    FROM likes
                    GROUP BY id_image ) l
                    ON image.id = l.id_image
                  LEFT JOIN
                  ( SELECT id_image, COUNT(*) AS cnt
                    FROM comment
                  GROUP BY id_image ) c
                    ON image.id = c.id_image
                WHERE image.id = :id
                AND `user`.`id` = `image`.id_user
                ";
        $stmt = DB::instance()->prepare($sql);
        $stmt->bindValue(':id', intval($id), PDO::PARAM_INT);
        $stmt->execute();
        $res = $stmt->fetch();
        return $res;
    } catch (PDOException $e) {
        return $e;
    }
}

function selectFeaturedPhotoList($max) {
    try {
        $sql = "SELECT image.id, `user`.login as `user`, image.name,
                  COALESCE( l.cnt, 0 ) AS likeCount,
                  COALESCE( c.cnt, 0 ) AS chatCount
                FROM `user`, image
                  LEFT JOIN
                  ( SELECT id_image, COUNT(*) AS cnt
                    FROM likes
                    GROUP BY id_image ) l
                    ON image.id = l.id_image
                  LEFT JOIN
                  ( SELECT id_image, COUNT(*) AS cnt
                    FROM comment
                  GROUP BY id_image ) c
                    ON image.id = c.id_image
                WHERE `user`.`id` = `image`.id_user
                ORDER BY likeCount DESC,
                  chatCount DESC,
                  image.id
                LIMIT  :max";
        $stmt = DB::instance()->prepare($sql);
        $stmt->bindValue(':max', intval($max), PDO::PARAM_INT);
        $stmt->execute();
        $res = $stmt->fetchALL();
        return $res;
    } catch (PDOException $e) {
        return $e;
    }
}