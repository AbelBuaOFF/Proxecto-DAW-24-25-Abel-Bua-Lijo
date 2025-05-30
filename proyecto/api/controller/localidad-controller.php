<?php

include_once ('controller.php');
include_once (PATH_MODEL."localidad-model.php");

class LocalidadController extends controller{
    
    public function get($id)
    {
        $model = new LocalidadModel();
        $result = $model->get($id);

        echo json_encode($result, JSON_PRETTY_PRINT);
    }
    public function getAll()
    {
        $model = new LocalidadModel();
        $result = $model->getAll();
    
        echo json_encode($result, JSON_PRETTY_PRINT);
    }
    public function delete($id)
    {
    }
    public function update($id, $object)
    {
    }
    public function insert($object)
    {
    }

}