<?php
include_once ('globals.php');
include_once (PATH_CONTROLLER."controller.php");
/*
    Captura de peticiones
*/
$metodo = $_SERVER['REQUEST_METHOD'];
$uri = $_SERVER['REQUEST_URI'];
$uri = explode("/", $uri);
$endpoint = $uri[3];
$id=null;

/*
    Funciones
*/

function getIds(array $uri):array{
    $ids = [];
    for($i=count($uri)-1;$i>=0;$i--){
        if(intval($uri[$i])){
            $ids[] = $uri[$i];
        }
    }
    return array_reverse($ids);
}

/*
    Peticiones
 */

 try{
    $controller = Controller::getController($endpoint);

    if ($id !== null) {
        # code...
    }else{
        $controller->getAll();
    }

 }catch (ControllerException $th){
       Controller::sendNotFound("Error en la peticion :".$th->getMessage());
       die();
    }