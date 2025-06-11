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
        $error=[];
        UsuarioModel::getUserByNombre($object["nombre_usuario"]) ? $error[] = "El nombre de usuario ya existe." : null;
        UsuarioModel::getUserByEmail($object["email"]) ? $error[] = "El email ya existe." : null;

        if (count($error) == 0) {
            $insercion = $model->addUser($object);
            if ($insercion) {
                $result = [
                    "status" => "success",
                    "message" => "Usuario insertado correctamente.",
                ];
            }else {
                $result = [
                    "status" => "error",
                    "message" => "Error al insertar un Usuario.",
                ];
            }
        }else{
            $result = [
                "status" => "error",
                "message" => "Error al insertar un Usuario.",
                "errors" => $error
            ];
        }
         
        echo json_encode($result, JSON_PRETTY_PRINT);
    }

    public function blockUser($id) {

        $model = new UsuarioModel();
        $result = $model->blockUser($id);
        echo json_encode($result, JSON_PRETTY_PRINT);
    }

    public function login($objecto) {
        $model = new UsuarioModel();
        $usuario =$model->login($objecto);
        if (isset($usuario["id"])) {
            $token = TokenAuthController::generateToken($usuario["id"]);
            $result = [
                "status" => "success",
                "message" => "Usuario logueado correctamente.",
                "id_usuario" => $usuario["id"],
                "token" => $token
            ];
            echo json_encode($result, JSON_PRETTY_PRINT);
        }else {
            
            if (UsuarioModel::getUserByNombre($objecto["nombre_usuario"])) {
                $mensage = "Contraseña incorrecta.";
            }else {
                $mensage = "Usuario no encontrado.";
            }
            $result = [
                "status" => "error",
                "message" => "$mensage"
            ];
            echo json_encode($result, JSON_PRETTY_PRINT);
        }
    }

	public function delete($id) {
        $model = new UsuarioModel();
        $result = $model->delete($id);
        if ($result) {
            $result = [
                "status" => "success",
                "message" => "Usuario eliminado correctamente."
            ];
            AnuncioModel::deleteAllByUser($id); 
        } else {
            $result = [
                "status" => "error",
                "message" => "Error al eliminar el usuario."
            ];
        }
        echo json_encode($result, JSON_PRETTY_PRINT);
	}

	public function update($id, $data) {
        //TODO
        $model = new UsuarioModel();
        $result = $model->updateUser($id, $data);
        if ($result) {
            $result = [
                "status" => "success",
                "message" => "Usuario actualizado correctamente."
            ];
        } else {
            $result = [
                "status" => "error",
                "message" => "Error al actualizar el usuario."
            ];
        }
        echo json_encode($result, JSON_PRETTY_PRINT);
	}

    public function changePassword($id,$data)  {
        
        $model = new UsuarioModel();
        $result = $model->changePassword($id, $data);
        if ($result) {
            $result = [
                "status" => "success",
                "message" => "Password actualizado correctamente."
            ];
        } else {
            $result = [
                "status" => "error",
                "message" => "Error al actualizar la password  del usuario."
            ];
        }
        echo json_encode($result, JSON_PRETTY_PRINT);
        
    }

	public function insert($data) {
        //TODO es addUser
	}
}