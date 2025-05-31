<?php

include_once("page-controller.php");
include_once(PATH_MODEL."solicitud-model.php");
class UserController extends PageController{

    public function __construct()
    {
        parent::__construct();
    }

    public static function home(){
        $vista = new View;
        $data = [];
        $solicitud = new Solicitud("categoria","getAll");
        $model = new SolicitudModel();
        $data['categorias'] = $model->enviarSolicitud($solicitud) ?? [];
        
        $solicitud = new Solicitud("localidad","getAll");
        $model = new SolicitudModel();
        $data['localidades'] = $model->enviarSolicitud($solicitud) ?? [];

        $solicitud = new Solicitud("usuario","get", $_SESSION['id_usuario']);
        $model = new SolicitudModel();
        $data['usuario'] = $model->enviarSolicitud($solicitud) ?? [];
         
        $vista->show("home",$data);

    }

    public static function userLogin(){
        $vista = new View;
        if (isset($_POST['nombre_usuario']) && isset($_POST['passw'])) {
        
        $data = [
            "nombre_usuario" => $_POST['nombre_usuario'],
            "passw" => $_POST['passw']
        ];

        $solicitud = new Solicitud("usuario","login", $data);

        

        MainController::index();
    }else{
        $data = ["error"];
        $vista->show("login",$data);
    }
    
    }

    public static function getAnunciosByUser($id_user){
        $data = [];
        $solicitud = new Solicitud("anuncio","getByUser",$id_user);
        $model = new SolicitudModel();
        $data['anuncios'] = $model->enviarSolicitud($solicitud) ?? [];
        
        echo json_encode($data['anuncios']);
    }
}