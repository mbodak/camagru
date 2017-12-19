<?php

class Router
{
    private $routes;


    public function _construct()
    {
        $routesPath = ROOT.'config/routes.php';
        $this->routes = include($routesPath);
    }


    public function run()
    {
        print_r(($this->routes));


        //Get required string


        //Check his required in routes.php


        //If true -> define controller and action


        //Connect class-controller file


        //Create object, call method (action)


    }


}