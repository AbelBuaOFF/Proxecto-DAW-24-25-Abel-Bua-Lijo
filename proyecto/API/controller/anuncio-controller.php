<?php

include_once ('controller.php');
include_once (PATH_MODEL."AnuncioModel.php");

class AnuncioController extends controller{
    

    public function get($id)
    {
        $model = new AnuncioModel();
        $anuncio = $model->get($id);
    }
    public function getAll()
    {
        $model = new AnuncioModel();
        return $model->getAll();
    }
    
    public function delete($id)
    {
        $model = new AnuncioModel();
        return $model->delete($id);
    }
    public function update($id, $object)
    {
        $model = new AnuncioModel();
        return $model->update($id, $object);
    }
    public function insert($object)
    {
        $model = new AnuncioModel();
        return $model->insert($object);
    }
}