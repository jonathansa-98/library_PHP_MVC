<?php

/* Loading files, and preparing enviroment*/
require_once 'autoload.php';
require_once 'config/constants.php';
require_once 'db/DB.php';
require_once 'helpers/Utils.php';
require_once 'models/User.php';
session_cache_limiter("nocache");
session_start();

/* Loading header*/
require_once 'views/layout/header.php';

/* Shows errors*/
function show_error(){
    $error = new ErrorController();
    $error->index();
}

/* Verifies that the URL contains a controller and an action*/
if(isset($_GET['controller'])){
    $name_controller = $_GET['controller'].'Controller'; 
}elseif(!isset($_GET['controller']) && !isset($_GET['action'])){
    $name_controller = DEFAULT_CONTROLLER;
}else{
    show_error();
    exit();
}

/* Execute the given controller*/
if(class_exists($name_controller)){
    $controller = new $name_controller();

    if(isset($_GET['action']) && method_exists($controller, $_GET['action'])){
        $action = $_GET['action'];
        $controller->$action();
    }elseif(!isset($_GET['controller']) && !isset($_GET['action'])){
        $default = DEFAULT_ACTION;
        $controller->$default();
    }else{
        show_error();
    }
}else{
    show_error();
}

/* Showing footer*/
require_once 'views/layout/footer.php';