<?php
include_once("model.php");
class Usuario extends ModelObject{

    public $id;
    public $nombre_usuario;
    public $email;
    public $password;
    public $id_rol;


    public function __construct($id = null, $nombre_usuario = null, $email = null, $password = null, $id_rol = null){
        
        $this->nombre_usuario = $nombre_usuario;
        $this->email = $email;
        $this->password = $password;
        $this->id_rol = $id_rol;
        $this->id = $id;
    }

    public static function fromJson($json): ModelObject {
        $data = json_decode($json);
        return new Usuario(
            $data->id ?? null,
            $data->nombre_usuario ?? null,
            $data->email ?? null,
            $data->password ?? null,
            $data->id_rol ?? null,
            
        );
    }

    public function toJson():String{
        return json_encode($this,JSON_PRETTY_PRINT);
    }
}
class UsuarioModel extends Model{

    public function getUser($usuario, $pass){
        $sql = "SELECT id, nombre_usuario ,email, passw, id_rol FROM usuario 
        WHERE nombre_usuario=:usuario AND passw=:passw AND borrado = 0";
        $pdo = Model::getConnection();
        $usuario = false;
        try {
            $statement = $pdo->prepare($sql);
            $statement->bindValue(':usuario', $usuario, PDO::PARAM_STR);
            $statement->bindValue(':passw', hash('sha256', $pass , PDO::PARAM_STR));
            $statement->execute();
            $usuario = $statement->fetch();
        } catch (\PDOException $th) {
            error_log("Error en->getUser() UsuarioModel");
            error_log($th->getMessage());
        } finally {
            $statement = null;
            $pdo = null;
        }

        return $usuario;
    }

    public function addUser($usuario): bool{
        $resultado= false;
        $sql = "INSERT INTO usuario (nombre_usuario, email, passw) 
                VALUES (:nombre_usuario, :email, :passw)";
        $pdo = Model::getConnection();
        try {
            $statement = $pdo->prepare($sql);
            $statement->bindValue(':nombre_usuario', $usuario->nombre_usuario, PDO::PARAM_STR);
            $statement->bindValue(':email', $usuario->email, PDO::PARAM_STR);
            $statement->bindValue(':passw', hash('sha256', $usuario->password, PDO::PARAM_STR));
            $resultado = $statement->execute();
            $resultado= true;
        } catch (\PDOException $th) {
            error_log("Error en->addUser() UsuarioModel");
            error_log($th->getMessage());

        } finally {
            $statement = null;
            $pdo = null;
            
        }
        return $resultado;
    }

    /*
        Poner el Borrado logico en true
        Para que no se pueda logear
    */
    public function blockUser($id):bool{

        $resultado= false;

        $sql = "UPDATE usuario SET borrado = 1 WHERE id = :id";
        $pdo = Model::getConnection();

        try {
            $statement = $pdo->prepare($sql);
            $statement->bindValue(':id', $id, PDO::PARAM_INT);

            $resultado = $statement->execute();
            $resultado= true;
        } catch (\PDOException $th) {
            error_log("Error en->blockUser($id) UsuarioModel");
            error_log($th->getMessage());

        } finally {
            $statement = null;
            $pdo = null;
            
        }
        return $resultado;
    }

    public function changePassword($id, $password):bool{

        $resultado= false;

        $sql = "UPDATE usuario SET passw = :passw WHERE id = :id";
        $pdo = Model::getConnection();

        try {
            $statement = $pdo->prepare($sql);
            $statement->bindValue(':id', $id, PDO::PARAM_INT);
            $statement->bindValue(':passw', hash('sha256', $password, PDO::PARAM_STR));

            $resultado = $statement->execute();
            $resultado= true;
        } catch (\PDOException $th) {
            error_log("Error en->changePassword($id) UsuarioModel");
            error_log($th->getMessage());

        } finally {
            $statement = null;
            $pdo = null;
            
        }
        return $resultado;
    }

}