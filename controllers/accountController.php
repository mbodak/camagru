<?php

    include_once ROOT.'/models/accountModel.php';

    class accountController {
        public function actionActivate() {
            accountModel::activateAccount();
            return (true);
        }
        public function actionRecover() {
            accountModel::recoverPassword();
            return (true);
        }
        public function actionCreate() {
            if (LOGGED_IN) {
                header("Location: ".LinkService::getRoot());
            }
            accountModel::createAccount();
            return (true);
        }
        public function actionLogin() {
            if (LOGGED_IN) {
                header("Location: ".LinkService::getRoot());
            }
            accountModel::logIn();
            return (true);
        }

        public function actionLogout() {
            if (!LOGGED_IN) {
                header("Location: ".LinkService::getRoot());
            }
            accountModel::logOut();
            return (true);
        }

        public function actionForgot() {
            if (LOGGED_IN) {
                header("Location: ".LinkService::getRoot());
            }
            accountModel::forgotPassword();
            return (true);
        }

        public function actionChange() {
            if (!LOGGED_IN) {
                header("Location: ".LinkService::getRoot());
            }
            // TODO change pass
            accountModel::changePassword();
            return (true);
        }

        public function actionNotifications() {
            if (!LOGGED_IN) {
                header("Location: ".LinkService::getRoot());
            }
            accountModel::notifications();
            header("Location: ".LinkService::getRoot());
            return (true);
        }

        public function actionIsEmailOccupied() {
            if ($_POST && isset($_POST['email'])) {
                if (accountModel::checkEmail($_POST['email'])) {
                    print "true";
                } else {
                    print "false";
                }
            }
            return (true);
        }

        public function actionIsLoginOccupied() {
            if ($_POST && isset($_POST['login'])) {
                if (accountModel::checkLogin($_POST['login'])) {
                    print "true";
                } else {
                    print "false";
                }
            }
            return (true);
        }

        public function actionPhoto() {
            if (!LOGGED_IN) {
                header("Location: ".LinkService::getRoot());
            }
            accountModel::takePhoto();
            return (true);
        }

        public function actionProfile() {
            if (!LOGGED_IN) {
                header("Location: ".LinkService::getRoot());
            }
            accountModel::profile();
            return (true);
        }

    }
