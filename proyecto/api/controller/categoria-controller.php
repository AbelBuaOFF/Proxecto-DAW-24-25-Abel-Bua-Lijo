<?php

include_once ('controller.php');
include_once (PATH_MODEL."categoria-model.php");

class CategoriaController extends controller{
    
    public function get($id)
    {
        $model = new CategoriaModel();
        $result = $model->get($id);

        echo json_encode($result, JSON_PRETTY_PRINT);
    }
    public function getAll()
    {
        $model = new CategoriaModel();
        $result = $model->getAll();
    
        echo json_encode($result, JSON_PRETTY_PRINT);
    }
    public function delete($id)
    {
        $model = new CategoriaModel();
        $result = $model->delete($id);
        echo json_encode($result, JSON_PRETTY_PRINT);
    }
    public function update($id, $object)
    {
        $model = new CategoriaModel();
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
        $model = new CategoriaModel();
        $result = Categoria::fromJson($object);
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