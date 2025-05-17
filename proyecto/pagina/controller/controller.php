<?php
include_once(PATH_VIEW."/view.php");

class Controller{
    protected View $vista;

    public function __construct()
    {
        $this->vista = new View();
    }

}