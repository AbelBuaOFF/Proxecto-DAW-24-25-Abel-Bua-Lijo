<?php

include_once ('controller.php');
include_once (PATH_MODEL."anuncio-model.php");

class AnuncioController extends controller{
    

    public function get($id)
    {
        $model = new AnuncioModel();
        $result = $model->get($id);

        echo json_encode($result, JSON_PRETTY_PRINT);
    }
    public function getAll()
    {
        $model = new AnuncioModel();
        $result = $model->getAll();
    
        echo json_encode($result, JSON_PRETTY_PRINT);
    }
    public function delete($id)
    {
        $model = new AnuncioModel();
        $result = $model->delete($id);
        echo json_encode($result, JSON_PRETTY_PRINT);
    }
    public function update($id, $object)
    {
        $model = new AnuncioModel();
        $result = $model->update($id, $object);
        echo json_encode($result, JSON_PRETTY_PRINT);

    }
    public function insert($object)
    {
        $model = new AnuncioModel();
        $result = $model->insert($object);
        echo json_encode($result, JSON_PRETTY_PRINT);
    }
}