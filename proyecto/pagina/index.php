<?php
include_once("globals.php");
include_once(PATH_CONTROLLER."/main-controller.php");
$controller = "MainController";
$action = "index";
if(isset($_REQUEST['controller']) && $_REQUEST['action']){
    $controller = $_REQUEST['controller'];
    $action = $_REQUEST['action'];
}try{
    $object = new $controller();
    $object->$action();
}catch(\Throwable $th){
    $object = new MainController();
    $object->index();
}