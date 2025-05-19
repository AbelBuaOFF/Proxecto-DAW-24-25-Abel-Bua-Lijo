<?php
include_once("controller.php");
class MainController extends Controller{

    public function __construct()
    {
        parent::__construct();
    }

    public function index(){
        $vista= new View;
        $data=null;
        $data['anuncios']=AnuncioModel::getAnuncios();
        $vista->show("main",$data);

    }
}