<?php
include_once ROOT.'/models/imageModel.php';

class imageController
{
    public function actionSave() {
        if (!LOGGED_IN) {
            exit();
        }
        imageModel::save();
        return (true);
    }
    public function actionRemove() {
        if (!LOGGED_IN) {
            exit();
        }
        if ($_POST && isset($_POST['id'])) {
            if (imageModel::remove(intval($_POST['id']))) {
                header("Location: ".LinkService::getRoot()."profile#removed");
            } else {
                header("Location: ".LinkService::getRoot()."profile#notRemoved");
            }
        }
        return (true);
    }
    public function actionLike() {
        if (!LOGGED_IN) {
            exit();
        }
        if ($_POST && isset($_POST['id'])) {
            imageModel::like(intval($_POST['id']));
        }
        return (true);
    }
    public function actionIsLiked() {
        if (!LOGGED_IN) {
            exit();
        }
        if ($_POST && isset($_POST['id'])) {
            if (imageModel::isLiked(intval($_POST['id']))) {
                print "true";
            } else {
                print "false";
            }
            exit();
        }
        return (true);
    }
    public function actionDislike() {
        if (!LOGGED_IN) {
            exit();
        }
        if ($_POST && isset($_POST['id'])) {
            if ($_POST && isset($_POST['id'])) {
                imageModel::dislike(intval($_POST['id']));
        }
        }
        return (true);
    }
}