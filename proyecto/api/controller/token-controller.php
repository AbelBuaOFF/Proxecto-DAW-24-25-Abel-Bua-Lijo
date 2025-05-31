<?php

include_once ('controller.php');
include_once (PATH_MODEL."token-model.php");

class TokenAuthController extends controller{

    public function get($id) {
        $model = new AuthTokenModel();
        $result = $model->getToken($id);
    
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
    
        echo json_encode($result, JSON_PRETTY_PRINT);
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