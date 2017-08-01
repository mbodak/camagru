<?php
    session_start();
    include ("database.php");

    if ($_POST['login'] != "" && $_POST['oldpw'] != "" && $_POST['newpw'] != "" && $_POST['submit'] == 'OK')
    {
        $id = -1;
        $result = mysqli_query($conn, "SELECT login, password FROM users");
        foreach ($result as $val)
        {
            if ($val['login'] == $_POST['login'] && $val['password'] == hash("sha512", $_POST['oldpw']))
                $id = $val['login'];
        }
        if ($id < 0)
        {
            echo "ERROR\n";
            return ;
        }
        $pw = hash("sha512", $_POST['newpw']);
        $str = "UPDATE users SET password = '".$pw."' WHERE login = '".$id."'";
        $result = mysqli_query($conn, $str);
        header("Location: index.php");
    }
    else
        echo "ERROR\n";
?>