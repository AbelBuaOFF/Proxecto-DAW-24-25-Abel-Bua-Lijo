<?php

include_once("page-controller.php");
include_once(PATH_MODEL."solicitud-model.php");
class MainController extends PageController{

    public function __construct()
    {
        parent::__construct();
    }

    public static function index(){
        $vista= new View;
        $data = [];
        $solicitud = new Solicitud("categoria","getAll");
        $model = new SolicitudModel();
        $data['categorias'] = $model->enviarSolicitud($solicitud) ?? [];
        
        $solicitud = new Solicitud("localidad","getAll");
        $model = new SolicitudModel();
        $data['localidades'] = $model->enviarSolicitud($solicitud) ?? [];

        $vista->show("main",$data);
    }

    public static function login(){
        $vista = new View;
        $vista->show("login");
    }
    public static function registro(){
        $vista = new View;
        $vista->show("registro");
    }

    public static function getAnuncios(){
        $data = [];
        $solicitud = new Solicitud("anuncio","getAll");
        $model = new SolicitudModel();
        $data['anuncios'] = $model->enviarSolicitud($solicitud) ?? [];
        
        echo json_encode($data['anuncios']);
    }

}