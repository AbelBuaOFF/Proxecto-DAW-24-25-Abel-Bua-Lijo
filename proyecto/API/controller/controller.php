<?php

define("CONTROLLER_ANUNCIO", "anuncio");
define("CONTROLLER_USUARIO", "usuario");
define("CONTROLLER_CATEGORIA", "categoria");

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
            /*
            case 'usuario':
                $controller = new UsuarioController();
                break;

            case 'categoria':
                $controller = new CategoriaController();
                break;
            */
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