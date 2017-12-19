<!DOCTYPE html>
<html lang="en">
<?php
    include ("head.php");


    //1 Configuration
    ini_set('display_errors', 1);
    error_reporting(E_ALL);




    //2 Connect files
    define('ROOT', dirname(__FILE__));
    require_once(ROOT.'/components/Router.php');


    //3 Connection with DB


    //4 Calling Router
    $router = new Router();
    $router->run();


?>
<body id="body">
<?php
    include ("header.php");
    include ("main.php");
    include ("footer.php");
?>
</body>
</html>
