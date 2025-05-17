<?php
include_once("controller.php");
class MainController extends Controller{

    public function __construct()
    {
        parent::__construct();
    }

    public function index(){
        $this->vista->show('main');

    }
}