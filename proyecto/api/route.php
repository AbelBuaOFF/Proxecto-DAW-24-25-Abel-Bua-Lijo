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

/*
    Funciones
*/

function extractFuntion($json) {

        $resultado = json_decode($json, true);
        
        $objeto = null;
        $id = null;

        if (isset($resultado['objeto'])) {
            $objeto = $resultado['objeto'];
            var_dump($objeto);
        }

        if (isset($resultado['id'])) {
            $id = $resultado['id'];
        }

        $funtion = $resultado['function'];

    return [
        'function' => $funtion,
        'id' => $id,
        'objeto' => $objeto
    ];
}

/*
    Peticiones
 */

 try{
    $controller = Controller::getController($endpoint);
    
    if (!$controller) {
        die("No se pudo cargar el controlador para el endpoint: $endpoint");
    }
            $json = file_get_contents('php://input');

            $resultado = extractFuntion($json);

            $funtion = $resultado['function'];
            $id = $resultado['id'];
            $objeto =$resultado['objeto'];

            var_dump($controller);
            var_dump($funtion);

            try {
                if ($objeto !== null && $id !== null) {
                    $controller->$funtion($id,$objeto);

                    
                }elseif($objeto !== null ){
                    $controller->$funtion($objeto);

                }elseif($id !== null){
                    $controller->$funtion($id);
                }else{
                    $controller->$funtion();
                }
            }
            catch (\Throwable $th) {
                Controller::sendNotFound("Error en la peticion: " . $th->getMessage());
                die();
            }

 }catch (ControllerException $th){
       Controller::sendNotFound("Error en la peticion :".$th->getMessage());
       die();
    }