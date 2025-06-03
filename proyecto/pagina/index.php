<?php
include_once("globals.php");
include_once(PATH_CONTROLLER."/main-controller.php");
include_once(PATH_CONTROLLER."/user-controller.php");
include_once(PATH_CONTROLLER."/anuncio-controller.php");
$controller = "MainController";
$action = "index";
    if(isset($_REQUEST['controller']) && $_REQUEST['action']){
        $controller = $_REQUEST['controller'];
        $action = $_REQUEST['action'];
    }try{
        $object = new $controller();
        if (isset($_REQUEST['id'])){
            $id = $_REQUEST['id'];
            $object->$action($id);
        }else{
            $object->$action();
        }
    }catch(\Throwable $th){
        error_log("Error controller:$controller,accion: $action");
        error_log($th->getMessage());
        $object = new MainController();
        $object->index();
    }