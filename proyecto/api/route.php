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

function getIds(array $uri){
    $id=null;
    for($i=count($uri)-1;$i>=0;$i--){
        if(intval($uri[$i])){
            $id = $uri[$i];
        }
    }
    return $id;
}

if (count($uri) >= 4) {
    try {
        $id = getIds($uri);
    } catch (Throwable $th) {

        Controller::sendNotFound("Error en la peticion. El parametro debe ser un id correcto.");
        die();
    }
}

/*
    Peticiones
 */

 try{
    $controller = Controller::getController($endpoint);
    if (!$controller) {
        die("No se pudo cargar el controlador para el endpoint: $endpoint");
    }

    switch ($metodo) {
        case 'POST':
            $json = file_get_contents('php://input');
            $controller->insert($json);
            break;
        case 'GET':
            if (isset($id)) {
                $controller->get($id);
            } else {
                $controller->getAll();
            }
            break;
        case 'DELETE':
            if (isset($id) ) {
                $controller->delete($id);
            } else {
                Controller::sendNotFound("Es necesario indicar el id correcto de la banda a eliminar.");
            }
            break;
        case 'PUT':
            if (isset($id) ) {
                $json = file_get_contents('php://input');
                $controller->update($id, $json);
            } else {
                Controller::sendNotFound("Es necesario indicar el id correcto de la banda a actualizar.");
            }
    
            break;
        default:
            Controller::sendNotFound("Método HTTP no disponible.");
    }

 }catch (ControllerException $th){
       Controller::sendNotFound("Error en la peticion :".$th->getMessage());
       die();
    }