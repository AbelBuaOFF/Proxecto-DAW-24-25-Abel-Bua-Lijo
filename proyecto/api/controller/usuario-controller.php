<?php

include_once ('controller.php');
include_once (PATH_MODEL."usuario-model.php");
include_once (PATH_CONTROLLER."token-controller.php");


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
        try{
            $result = Usuario::fromJson($object);
            if ($model->addUser($result)) {
                echo json_encode([
                    "status" => "success",
                    "message" => "Usuario insertado correctamente."
                ], JSON_PRETTY_PRINT);
        }
        }catch (Throwable $th) {
            Controller::sendNotFound("Error al insertar un Usuario.");
            error_log($th->getMessage());
            echo json_encode([
                "status" => "error",
                "message" => "Error al insertar un Usuario."
            ], JSON_PRETTY_PRINT);
        } 
    }

    public function blockUser($id) {

        $model = new UsuarioModel();
        $result = $model->blockUser($id);
        echo json_encode($result, JSON_PRETTY_PRINT);
    }

    public function login($objecto) {
        $model = new UsuarioModel();
        $usuario =$model->login($objecto);
        if ($usuario) {
            $token = TokenAuthController::generateToken($usuario["id"]);
            $result = [
                "status" => "success",
                "message" => "Usuario logueado correctamente.",
                "id_usuario" => $usuario["id"],
                "token" => $token
            ];
            echo json_encode($result, JSON_PRETTY_PRINT);
        }else {
            $result = [
                "status" => "error",
                "message" => "Error al loguear el usuario."
            ];
            echo json_encode($result, JSON_PRETTY_PRINT);
        }
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