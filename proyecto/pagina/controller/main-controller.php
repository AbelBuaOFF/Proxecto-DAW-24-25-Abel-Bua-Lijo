<?php
include_once("page-controller.php");
include_once(PATH_LIB."solicitud-class.php");
class MainController extends PageController{

    public function __construct()
    {
        parent::__construct();
    }

    public function index(){
        $vista= new View;
        $data = [];
        $solicitud = new Solicitud("anuncio","getAll");
        $data['anuncios'] = MainController::enviarSolicitud($solicitud) ?? [];
        $vista->show("main",$data);
    }
    
}