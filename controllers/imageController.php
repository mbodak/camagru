<?php
include_once ROOT.'/models/imageModel.php';

class imageController
{
    public function actionSave() {
        imageModel::save();
        return (true);
    }
}