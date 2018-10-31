<?php
include_once ROOT.'/models/camagruModel.php';

class camagruController {
    public function actionHome() {
        camagruModel::home();
        return (true);
    }

    public function actionAbout() {
        camagruModel::about();
        return (true);
    }
}
