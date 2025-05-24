<?php
include_once("controller.php");
class MainController extends PageController{

    public function __construct()
    {
        parent::__construct();
    }

    public function index(){
        $vista= new View;
        $vista->show("main");
    }
    
}