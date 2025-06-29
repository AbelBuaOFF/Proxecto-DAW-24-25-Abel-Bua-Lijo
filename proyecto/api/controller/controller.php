<?php
define("CONTROLLER_ANUNCIO", "anuncio");
define("CONTROLLER_USUARIO", "usuario");
define("CONTROLLER_CATEGORIA", "categoria");

include_once (PATH_CONTROLLER."anuncio-controller.php");
include_once (PATH_CONTROLLER."usuario-controller.php");
include_once (PATH_CONTROLLER."token-controller.php");
include_once (PATH_CONTROLLER."categoria-controller.php");
include_once (PATH_CONTROLLER."localidad-controller.php");
include_once (PATH_CONTROLLER."tipo-anuncio-controller.php");

class controllerException extends Exception{
    function __construct()
    {
        parent::__construct("Error obteniendo el controlador solicitado.");
    }
}

 abstract class controller{
  
    public static function sendNotFound($mensaje)
    {
        error_log($mensaje);
        header("HTTP/1.1 404 Not Found");
        $mensaje = ["error" => $mensaje];
        echo json_encode($mensaje, JSON_PRETTY_PRINT);
    }

    public static function getController ($nombre){

        $controller = null;
        switch ($nombre) {
            case 'anuncio':
                $controller = new AnuncioController();
                break;
            
            case 'usuario':
                $controller = new UsuarioController();
                break;

            case 'token':
                $controller = new TokenAuthController();
                break;

            case 'categoria':
                $controller = new CategoriaController();
                break;

            case 'localidad':
                $controller = new LocalidadController();
                break;

            case 'tipoanuncio':
                    $controller = new TipoAnuncioController();
                    break;

            default:
                throw new controllerException();        
        }
        
        return $controller;
    }

    public abstract function get($id);
    public abstract function getAll();
    public abstract function delete($id);
    public abstract function update($id, $object);
    public abstract function insert($object);

 }