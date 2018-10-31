<?php

class imageModel
{
    public static function save() {
        if ($_POST && isset($_POST['file'])) {
            $image = str_replace('data:image/png;base64,', '', $_POST['file']);
            $image = str_replace(' ', '+', $image);
            $imageData = base64_decode($image);
            $imageName = USER['id'].round(microtime(1) * 1000).".jpg";
            imagejpeg(imagecreatefromstring($imageData), IMAGE_DIRECTORY.$imageName, 85);
            Images::add($imageName, USER['id']);
            exit();
        }
    }
    public static function remove($id) {
        return Images::remove($id, USER['id']);
    }
    public static function like($id) {
        return Likes::add(USER['id'], $id);
    }
    public static function dislike($id) {
        return Likes::remove(USER['id'], $id);
    }
    public static function isLiked($id) {
        return Likes::isLiked(USER['id'], $id);
    }
}