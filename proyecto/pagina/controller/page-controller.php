<?php
include_once(PATH_VIEW."/view.php");

abstract class PageController{
    protected View $vista;

    public function __construct()
    {
        $this->vista = new View();
    }

}