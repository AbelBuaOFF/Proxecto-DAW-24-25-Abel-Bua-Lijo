<?php

include_once ('controller.php');
include_once (PATH_MODEL."usuario-model.php");


class UsuarioController extends controller{

	public function get($id) {
        $model = new UsuarioModel();
        $result = $model->get($id);
    
        echo json_encode($result, JSON_PRETTY_PRINT);
	}

	public function getAll() {
        $model = new UsuarioModel();
        $result = $model->getAll();
    
        echo json_encode($result, JSON_PRETTY_PRINT);

	}

    public function addUser($object) {

        $model = new UsuarioModel();
        $result = Usuario::fromJson($object);
        if ($model->addUser($result)) {
            echo json_encode([
                "status" => "success",
                "message" => "Usuario insertado correctamente."
            ], JSON_PRETTY_PRINT);
        }else {
            Controller::sendNotFound("Error al insertar un Usuario.");
            die();
        } 
    }

    public function blockUser($id) {

        $model = new UsuarioModel();
        $result = $model->blockUser($id);
        echo json_encode($result, JSON_PRETTY_PRINT);
    }

    public function login($objecto) {
        $model = new UsuarioModel();
        $result = $model->login($objecto);
        echo json_encode($result, JSON_PRETTY_PRINT);
    }


	public function delete($id) {
        //TODO
	}

	public function update($id, $data) {
        //TODO
	}

	public function insert($data) {
        //TODO
	}
}