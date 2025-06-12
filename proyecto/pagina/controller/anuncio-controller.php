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

    public static function updateAnuncioPage($anuncio_id){

        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        if (!isset($_SESSION['id_usuario']) ||  !isset($_SESSION['token'])){
            header("Location: ?controller=MainController&action=index");
         }

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

            $solicitud = new Solicitud("categoria","getAll");
            $model = new SolicitudModel();
            $data['categorias'] = $model->enviarSolicitud($solicitud);
            
            $solicitud = new Solicitud("localidad","getAll");
            $model = new SolicitudModel();
            $data['localidades'] = $model->enviarSolicitud($solicitud);

            $solicitud = new Solicitud("tipoanuncio","getAll");
            $model = new SolicitudModel();
            $data["tipo_anuncio"]= $model->enviarSolicitud($solicitud);

            $vista->show("update-anuncio", $data);
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

            if (isset($_FILES['imagen']) && $_FILES['imagen']['error'] === UPLOAD_ERR_OK) {
                $rutaImg=AnuncioController::guardarImgAnuncio($_FILES['imagen'], $_POST['titulo']);

                if($rutaImg==false){
                    $respuesta = ["error"=>"Error al subir la imagen"];
                }
            
            }else{
                $rutaImg= "/pagina/uploads/anuncio/anuncio_default.jpg";  
            }

            
            $data = new stdClass();
                $data->titulo = trim($_POST['titulo']);
                $data->descripcion = trim($_POST['descripcion']);
                $data->contenido = trim($_POST['contenido']);
                $data->id_tipo_anuncio = $_POST['id_tipo_anuncio'];
                $data->id_categoria = $_POST['id_categoria'];
                $data->id_localidad = $_POST['id_localidad'];
                $data->id_usuario = $_SESSION['id_usuario'];
                $data->imagen_url = $rutaImg;
                
            
            $solicitud = new Solicitud("anuncio","insert",null, $data);
            $model = new SolicitudModel();
            $data = $model->enviarSolicitud($solicitud);
            if (isset($data["status"]) && $data["status"] == "success") {

               header("Location: /pagina/index.php?controller=UserController&action=home");
                
            }
            $solicitud = new Solicitud("categoria","getAll");
            $model = new SolicitudModel();
            $data['categorias'] = $model->enviarSolicitud($solicitud);
            
            $solicitud = new Solicitud("localidad","getAll");
            $model = new SolicitudModel();
            $data['localidades'] = $model->enviarSolicitud($solicitud);
    
            $solicitud = new Solicitud("tipoanuncio","getAll");
            $model = new SolicitudModel();
            $data['tipos_anuncio'] = $model->enviarSolicitud($solicitud);

            }else{
                $respuesta = ["error"=>"Error al publicar"];
                $vista->show("login",$respuesta);
            } 
    }

    public static function updateAnuncio(){

        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        
        $vista = new View;
        if (isset($_POST['id_anuncio']) && isset($_POST['titulo']) && isset($_POST['descripcion'])&& isset($_POST['contenido'])) {

            if (isset($_FILES['imagen']) && $_FILES['imagen']['error'] === UPLOAD_ERR_OK) {
                $rutaImg=AnuncioController::guardarImgAnuncio($_FILES['imagen'], $_POST['titulo']);

                if($rutaImg==false){
                    $respuesta = ["error"=>"Error al subir la imagen"];
                }
            
            }else{
                $rutaImg = null;  
            }

            var_dump($_POST);

            $anuncio_id = (int) $_POST['id_anuncio'];
            $data = new stdClass();
                $data->titulo = trim($_POST['titulo']);
                $data->descripcion = trim($_POST['descripcion']);
                $data->contenido = trim($_POST['contenido']);
                $data->id_tipo_anuncio = $_POST['id_tipo_anuncio'];
                $data->id_categoria = $_POST['id_categoria'];
                $data->id_localidad = $_POST['id_localidad'];
                $data->imagen_url = $rutaImg;
            
            $solicitud = new Solicitud("anuncio","update",$anuncio_id, $data);
            $model = new SolicitudModel();
            $respuesta = $model->enviarSolicitud($solicitud);
            if (isset($respuesta["status"]) && $respuesta["status"] == "success") {

               header("Location: /pagina/index.php?controller=UserController&action=home");  
               exit();
            }

            header("Location: /pagina/index.php?controller=AnuncioController&action=updateAnuncioPage&id=$anuncio_id");
            exit();
            
            }else{
                $respuesta = ["error"];
                $vista->show("login",$respuesta);
            }

    }

    public static function deleteAnuncio($anuncio_id){
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        $vista = new View;

        $solicitud = new Solicitud("anuncio","delete",$anuncio_id,null);
        $model = new SolicitudModel();
        $model->enviarSolicitud($solicitud);
        
        $vista->show("home");
    }

    public static function guardarImgAnuncio($img,$titulo){
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        $id_usuario = $_SESSION['id_usuario'];
        $nombreImg = $id_usuario."_".$titulo.".jpg";
        $ruta = PATH_UPLOADS."anuncio/".$nombreImg;

        if(move_uploaded_file($img['tmp_name'], $ruta)){
            return substr($ruta, 4); ;
        }else{
            return false;
        }
    }
}