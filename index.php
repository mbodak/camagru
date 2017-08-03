<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>Camagru</title>
</head>
<body>

<?php
    session_start();
    include ("database.php");
    $result = mysqli_query($conn, "SELECT login, password FROM users");
    foreach ($result as $val)
    {
        if ($val['login'] == $_POST['login'] && $val['password'] == hash("sha512", $_POST['password']))
            setcookie("login", $_POST['login'], time()+3600);
    }
//    $_SESSION['thing'] = $_GET['thing'];
    include ("header.php");
    include ("main.php");
    include ("footer.php");
?>
</body>
</html>