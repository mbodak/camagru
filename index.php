<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>Camagru</title>

    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="style/header.css?v=<?=time();?>" rel='stylesheet' type='text/css'>
    <link href="style/main.css?v=<?=time();?>" rel='stylesheet' type='text/css'>
    <link href="style/footer.css?v=<?=time();?>" rel='stylesheet' type='text/css'>

    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <script type="text/javascript" src="js/index.js"></script>
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

?>
<div class="w3-sidebar w3-bar-block w3-card-2 w3-animate-left" style="display:none" id="mySidebar">
    <button class="w3-bar-item w3-button w3-large" onclick="w3_close()">Close &times;</button>
    <a href="#" class="w3-bar-item w3-button">Link 1</a>
    <a href="#" class="w3-bar-item w3-button">Link 2</a>
    <a href="#" class="w3-bar-item w3-button">Link 3</a>
</div>
<!--    <div id="main-1" class="w3-main">-->
        <?php
            include ("header.php");
            include ("main.php");
            include ("footer.php");
        ?>

<!--    </div>-->
</body>

</html>