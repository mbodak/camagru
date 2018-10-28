<?php
require_once 'database.php';

echo 'DB INITIALIZATION HAD STARTED'.'<br>';

function createDatabase(PDO $pdo) {
    $pdo->query('CREATE DATABASE IF NOT EXISTS '.DATABASE_NAME);
    $pdo->query('USE '.DATABASE_NAME);
}
function recreateUsersTable(PDO $pdo) {
    $pdo->query('DROP TABLE IF EXISTS `users`');
    $pdo->query('CREATE TABLE `users` (
                              `id` int(11) NOT NULL,
                              `email` varchar(254) NOT NULL,
                              `login` varchar(22) NOT NULL,
                              `passwd` varchar(254) NOT NULL,
                              `is_activated` tinyint(1) NOT NULL,
                              `code` varchar(10) NOT NULL,
                              `notif_enabled` tinyint(1) NOT NULL
                            ) ENGINE=InnoDB DEFAULT CHARSET=utf8;');
    $pdo->query('ALTER TABLE `users` ADD PRIMARY KEY (`id`),
                                ADD UNIQUE KEY `email` (`email`);');
    $pdo->query('ALTER TABLE `users` MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;');
}
function recreateImagesTable(PDO $pdo) {
    $pdo->query('DROP TABLE IF EXISTS `images`');
    $pdo->query('CREATE TABLE `images` (
                              `id` int(11) NOT NULL,
                              `name` varchar(40) NOT NULL,
                              `user_id` int(11) NOT NULL
                            ) ENGINE=InnoDB DEFAULT CHARSET=utf8;');
    $pdo->query('ALTER TABLE `images` ADD PRIMARY KEY (`id`);');
    $pdo->query('ALTER TABLE `images` MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;');
}
function recreateLikesTable(PDO $pdo) {
    $pdo->query('DROP TABLE IF EXISTS `likes`');
    $pdo->query('CREATE TABLE `likes` (
                              `user_id` int(11) NOT NULL,
                              `image_id` int(11) NOT NULL
                            ) ENGINE=InnoDB DEFAULT CHARSET=utf8;');
    $pdo->query('ALTER TABLE `likes` ADD PRIMARY KEY( `user_id`, `image_id`);');
}
function recreateSessionsTable(PDO $pdo) {
    $pdo->query('DROP TABLE IF EXISTS `sessions`');
    $pdo->query('CREATE TABLE `sessions` (
                              `id` int(11) NOT NULL,
                              `user_id` int(11) NOT NULL,
                              `session_code` varchar(20) NOT NULL
                            ) ENGINE=InnoDB DEFAULT CHARSET=utf8;');
    $pdo->query('ALTER TABLE `sessions` ADD PRIMARY KEY (`id`);');
    $pdo->query('ALTER TABLE `sessions` MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;');
}

function addAdminUser(PDO $pdo) {
    $pdo->query('INSERT INTO `users` (`id`, `email`, `login`, `passwd`, `is_activated`, `code`, `notif_enabled`) VALUES ("1", "bodak.marina.ev@gmail.com", "admin", "8c6976e5b5410415bde908bd4dee15dfb167a9c873fc4bb8a81f6f2ab448a918", "1", "0", "1");');
}

try {
    $pdo = new PDO('mysql:host='.DATABASE_HOST.';port='.DATABASE_PORT.';dbname=;charset='.DATABASE_CHARSET, DATABASE_USER, DATABASE_PASSWORD, DATABASE_OPT);
    createDatabase($pdo);
    recreateUsersTable($pdo);
    recreateImagesTable($pdo);
    recreateLikesTable($pdo);
    recreateSessionsTable($pdo);
    addAdminUser($pdo);
    $pdo = null;
} catch (PDOException $e) {
    echo '<div style="color:red;">'.$e->getMessage().'</div>';
    echo 'DB WAS NOT INITIALIZED CORRECTLY'.'<br>';
    exit();
}
echo 'DB WAS SUCCESSFULLY INITIALIZED'.'<br>';
echo 'REDIRECT IN 5s'.'<br>';
header( 'refresh:5;url=../' );
