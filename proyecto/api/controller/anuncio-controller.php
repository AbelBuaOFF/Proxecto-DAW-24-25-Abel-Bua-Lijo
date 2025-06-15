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
        $result = Anuncio::fromJson($object);
        if($model->update($id,$result)) {
            echo json_encode([
                "status" => "success",
                "message" => "Anuncio Actualizado correctamente."
            ], JSON_PRETTY_PRINT);
        }else {
            Controller::sendNotFound("Error al insertar el anuncio.");
            die();
        }

    }
    public function insert($object)
    {
        $model = new AnuncioModel();
        $result = Anuncio::fromJson($object);
        if ($model->insert($result)) {
            echo json_encode([
                "status" => "success",
                "message" => "Anuncio insertado correctamente."
            ], JSON_PRETTY_PRINT);
        }else {
            Controller::sendNotFound("Error al insertar el anuncio.");
            die();
        }
    }

    public function blockAnuncio($id_anuncio){
        
        $model = new AnuncioModel();
        $result = $model->blockAnuncio($id_anuncio);
    
        echo json_encode($result, JSON_PRETTY_PRINT);
    }

    public function getByUser($id_usuario)
    {
        $model = new AnuncioModel();
        $result = $model->getByUser($id_usuario);
    
        echo json_encode($result, JSON_PRETTY_PRINT);
    }

    public function getByCategoria($id_usuario)
    {
        $model = new AnuncioModel();
        $result = $model->getByCategoria($id_usuario);
    
        echo json_encode($result, JSON_PRETTY_PRINT);
    }

    public function deleteAllByUser($id_usuario)
    {
        $model = new AnuncioModel();
        $result = $model->deleteAllByUser($id_usuario);
    
        echo json_encode($result, JSON_PRETTY_PRINT);
    }
}