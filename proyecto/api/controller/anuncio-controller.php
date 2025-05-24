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
        var_dump($object);
        $result = Anuncio::fromJson($object);
        var_dump($result);
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
}