<?php
include_once ROOT.'/models/imageModel.php';

class imageController
{
    public function actionSave() {
        imageModel::save();
        return (true);
    }
    public function actionRemove() {
        if ($_POST && isset($_POST['id'])) {
            if (imageModel::remove(intval($_POST['id']))) {
                header("Location: ".LinkService::getRoot()."profile#removed");
            } else {
                header("Location: ".LinkService::getRoot()."profile#notRemoved");
            }
        }
        return (true);
    }
}