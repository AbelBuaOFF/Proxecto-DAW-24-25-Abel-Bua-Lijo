<?php

include_once ('controller.php');
include_once (PATH_MODEL."tipo-anuncio-model.php");

class TipoAnuncioController extends controller{
    
    public function get($id)
    {
        $model = new TipoAnuncioModel();
        $result = $model->get($id);

        echo json_encode($result, JSON_PRETTY_PRINT);
    }
    public function getAll()
    {
        $model = new TipoAnuncioModel();
        $result = $model->getAll();
    
        echo json_encode($result, JSON_PRETTY_PRINT);
    }
    public function delete($id)
    {
        $model = new TipoAnuncioModel();
        $result = $model->delete($id);
        echo json_encode($result, JSON_PRETTY_PRINT);
    }
    public function update($id, $object)
    {
        $model = new TipoAnuncioModel();
        $result = TipoAnuncio::fromJson($object);
        if($model->update($id,$result)) {
            echo json_encode([
                "status" => "success",
                "message" => "TipoAnuncio Actualizado correctamente."
            ], JSON_PRETTY_PRINT);
        }else {
            Controller::sendNotFound("Error al TipoAnuncio el anuncio.");
            die();
        }

    }
    public function insert($object)
    {
        $model = new TipoAnuncioModel();
        $result = TipoAnuncio::fromJson($object);
        if ($model->insert($result)) {
            echo json_encode([
                "status" => "success",
                "message" => "TipoAnuncio insertado correctamente."
            ], JSON_PRETTY_PRINT);
        }else {
            Controller::sendNotFound("Error al insertar el TipoAnuncio.");
            die();
        }
    }

}