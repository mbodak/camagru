<?php
require_once __DIR__.'/../database/index.php';

if ($_POST && $_POST['email']) {
    if (Users::isEmailOccupied($_POST['email'])) {
        print 'true';
    }
}
print 'false';