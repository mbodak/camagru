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
<!--    <link href="style/login.css?v=--><?//=time();?><!--" rel='stylesheet' type='text/css'>-->

    <link href="style/sidebar.css?v=<?=time();?>" rel='stylesheet' type='text/css'>
    <link href="style/searchform.css?v=<?=time();?>" rel='stylesheet' type='text/css'>

    <script type="text/javascript" src="js/index.js"></script>
</head>

<body id="body">

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
<div id="invisibleBox" style="display:none" onclick="w3_close()"></div>

<aside class="w3-sidebar w3-bar-block w3-card-2 w3-animate-left" style="display:none" id="mySidebar">
    <h3>Menu</h3>
    <nav role="navigation">
        <ul>
            <li>
                <a href="#" class="w3-bar-item w3-button">Home</a>
            </li>
            <li>
                <a href="#" class="w3-bar-item w3-button">Profile</a>
            </li>
            <li>
                <a href="#" class="w3-bar-item w3-button">Take photo</a>
            </li>
        </ul>
        <ul>
            <li>
                <a href="#" class="w3-bar-item w3-button">Logout</a>
            </li>
        </ul>
    </nav>
</aside>

<div class="search-overlay" style="display: none;" id="mySearch">
    <svg class="close-search-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 64 64" onclick="close_search()">
        <polygon points="64,5.9 58.1,0 32,26.1 5.9,0 0,5.9 26.1,32 0,58.1 5.9,64 32,37.9 58.1,64 64,58.1 37.9,32"></polygon>
    </svg>
    <form role="search" method="get" class="search-form" action="http://localhost:8080/Camagru/">
        <div>
            <input type="text" value="" name="s" id="s" placeholder="Type and press enter">
        </div>
    </form>
    <form role="search" method="get" class="search-form" action="http://localhost:8080/Camagru/">
        <div>
            <input type="text" value="" name="s" id="s" placeholder="Type and press enter">
        </div>
    </form>
</div>
<!--    <div>-->
        <?php
            include ("header.php");
            include ("main.php");
//            include ("login.php");
            include ("footer.php");

        ?>

<!--    </div>-->
</body>

</html>