<?php

include_once ('controller.php');
include_once (PATH_MODEL."token-model.php");

class TokenAuthController extends controller{

    public function get($id) {
        $model = new AuthTokenModel();
        $result = $model->getToken($id);
        if (!$result) {
            $result = [
                "status" => "error",
                "message" => "Token no encontrado."
            ];
        }else{
            $result = [
                "status" => "success",
                "message" => "Token encontrado.",
                "id_usuario" => $result->id_usuario,
                "token" => $result->token,
                "fecha_expiracion" => $result->fecha_expiracion
            ];
        }
        echo json_encode($result, JSON_PRETTY_PRINT);
	}

    public static function generateToken($id_usuario) {
        TokenAuthController::borrarToken($id_usuario);
        $model = new AuthTokenModel();
        $result =$model->generateToken($id_usuario);
        return $result;
	}

    public static function borrarToken($id_usuario) {
        $model = new AuthTokenModel();
        $result = $model->borrarToken($id_usuario);
	}

    public function getAll() {
        //TODO
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