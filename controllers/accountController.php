<?php

    include_once ROOT.'/models/accountModel.php';

    class accountController {
        public function actionCreate() {
            accountModel::createAccount();
            return (true);
        }

        public function actionActivation($login, $id) {
            accountModel::activateAccount($login, $id);
            return (true);
        }

        public function actionLogin() {
            accountModel::logIn();
            return (true);
        }

        public function actionLogout() {
            accountModel::logOut();
            return (true);
        }

        public function actionForgot() {
            accountModel::forgotPassword();
            return (true);
        }

        public function actionRecover() {
            accountModel::recoverPassword();
            return (true);
        }

        public function actionChange() {
            accountModel::changePassword();
            return (true);
        }

        public function actionNotification() {
            accountModel::notifications();
            return (true);
        }

        public function actionPhoto() {
            accountModel::takePhoto();
            return (true);
        }

        public function actionProfile() {
            accountModel::profile();
            return (true);
        }

    }
