<?php

include_once("page-controller.php");
include_once(PATH_MODEL."solicitud-model.php");
class AnuncioController extends PageController{

    public function __construct()
    {
        parent::__construct();
    }

    public static function getAnunciosByUser(){
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        $data = new stdClass();
            $data->id_usuario = $_SESSION['id_usuario'];
        $solicitud = new Solicitud("anuncio","getByUser",null,$data);
        $model = new SolicitudModel();
        $resultado['anuncios'] = $model->enviarSolicitud($solicitud) ?? [];
        
        echo json_encode($resultado['anuncios']);
    }

    public static function anuncioPage($anuncio_id){

        $vista = new View;
        $data = [];

        $solicitud = new Solicitud("anuncio","get",$anuncio_id, null);
            $model = new SolicitudModel();
            $data["anuncio"] = (object) $model->enviarSolicitud($solicitud);

        if (!$data["anuncio"]) {
            header("Location: /pagina/index.php?controller=MainController&action=index");
        }else{
            $id_categoria=$data["anuncio"]->id_categoria;
            $id_localidad=$data["anuncio"]->id_localidad;
            $id_usuario=$data["anuncio"]->id_usuario;

            $solicitud = new Solicitud("categoria","get",$id_categoria, null);
            $model = new SolicitudModel();
            $data["categoria"]=(object)  $model->enviarSolicitud($solicitud);

            $solicitud = new Solicitud("localidad","get",$id_localidad, null);
            $model = new SolicitudModel();
            $data["localidad"]=  (object)  $model->enviarSolicitud($solicitud);

            $solicitud = new Solicitud("usuario","get",$id_usuario, null);
            $model = new SolicitudModel();
            $data["usuario"]=  (object)  $model->enviarSolicitud($solicitud);

             $vista->show("anuncio", $data);
        }
    } 

    public static function publicarAnuncio(){

        $vista = new View;
        $data = [];
        $solicitud = new Solicitud("categoria","getAll");
        $model = new SolicitudModel();
        $data['categorias'] = $model->enviarSolicitud($solicitud);
        
        $solicitud = new Solicitud("localidad","getAll");
        $model = new SolicitudModel();
        $data['localidades'] = $model->enviarSolicitud($solicitud);

        $solicitud = new Solicitud("tipoanuncio","getAll");
        $model = new SolicitudModel();
        $data['tipos_anuncio'] = $model->enviarSolicitud($solicitud);
        $vista->show("publicar", $data);
        
    }


    public static function sendAnuncio(){
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        $vista = new View;
        if (isset($_POST['titulo']) && isset($_POST['descripcion'])&& isset($_POST['contenido'])) {
            $data = new stdClass();
                $data->titulo = $_POST['titulo'];
                $data->descripcion = $_POST['descripcion'];
                $data->contenido = $_POST['contenido'];
                $data->id_tipo_anuncio = $_POST['id_tipo_anuncio'];
                $data->id_categoria = $_POST['id_categoria'];
                $data->id_localidad = $_POST['id_localidad'];
                $data->id_usuario = $_SESSION['id_usuario'];
                if (isset($_POST['imagen'])) {
                    $data->imagen = $_POST['imagen'];  
                }else{
                    $data->imagen = "/pagina//uploads/anuncio/anuncio_default.jpg";  
                }
            
            $solicitud = new Solicitud("anuncio","insert",null, $data);
            $model = new SolicitudModel();
            $data = $model->enviarSolicitud($solicitud);
            if (isset($data["status"]) && $data["status"] == "success") {

               header("Location: /pagina/index.php?controller=UserController&action=home");
                
            }
            $vista->show("publicar",$data);
    
            }else{
                $respuesta = ["error"];
                $vista->show("login",$respuesta);
            } 
    }

}