<?php
    include ("database.php");

    $result = mysqli_query($conn, "SELECT login, password FROM users");
    foreach ($result as $val)
    {
        if ($val['login'] == $_POST['login'] && $val['password'] == hash("sha512", $_POST['password']))
            setcookie("login", $_POST['login'], time()+3600);
    }
    header("Location: index.php");
?>


