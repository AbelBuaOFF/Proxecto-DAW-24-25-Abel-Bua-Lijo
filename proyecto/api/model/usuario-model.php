<?php
include_once("model.php");
class Usuario extends ModelObject{

    public $id;
    public $nombre_usuario;
    public $email;
    public $password;
    public $tipo_usuario;       
    public $nombre_comercial;   
    public $url_web;
    public $id_rol;            

    public function __construct($nombre_usuario = null, $email = null, $password = null,$tipo_usuario = null, 
                                $nombre_comercial = null, $url_web = null, $id_rol = null,$id = null) {
        
        $this->nombre_usuario = $nombre_usuario;
        $this->email = $email;
        $this->password = $password;
        $this->tipo_usuario = $tipo_usuario;
        $this->nombre_comercial = $nombre_comercial;
        $this->url_web = $url_web;
        $this->id_rol = $id_rol;
        $this->id = $id;
    }

    public static function fromJson($json): ModelObject {
            $data = $json;
            return new Usuario(
                $data['nombre_usuario'] ?? null,
                $data['email'] ?? null,
                $data['password'] ?? null,
                $data['tipo_usuario'] ?? null,
                $data['nombre_comercial'] ?? null,
                $data['url_web'] ?? null,
                $data['id_rol'] ?? null,
                $data['id']?? null
            );
    }
    public function toJson():String{
        return json_encode($this,JSON_PRETTY_PRINT);
    }
}
class UsuarioModel extends Model{

    public function getAll() {
        $sql = "SELECT nombre_usuario, email, id_rol,tipo_usuario,nombre_comercial,url_web,id  FROM Usuario Where borrado = 0";
        $pdo = Model::getConnection();
        $resultado = [];
        
        try {
            $statement = $pdo->query($sql);
            foreach ($statement as $row) {
                $anuncio = new Usuario(
                    $row['nombre_usuario'] ?? null,
                    $row['email'] ?? null,
                    null,
                    $row['tipo_usuario'] ?? null,
                    $row['nombre_comercial'] ?? null,
                    $row['url_web'] ?? null,
                    $row['id_rol'] ?? null,
                    $row['id'] ?? null
                );
                array_push($resultado, $anuncio);
            }
        } catch (\Throwable $th) {
            error_log("Error en->getAll() Usuarios");
            error_log($th->getMessage());
        }finally{
            $statement = null;
            $pdo = null;
        }
        return $resultado;
    }

    public function get($id){
        $sql = "SELECT nombre_usuario, email, id_rol,tipo_usuario,nombre_comercial,url_web  FROM Usuario Where id=:id";
        $pdo = Model::getConnection();
        $resultado = null;
        try {
            $statement = $pdo->prepare($sql);
            $statement->bindValue(':id', $id, PDO::PARAM_INT);
            $statement->execute();


            if ($row=$statement->fetch()) {
                $resultado = new Usuario(
                    $row['nombre_usuario'] ?? null,
                    $row['email'] ?? null,
                    null,
                    $row['tipo_usuario'] ?? null,
                    $row['nombre_comercial'] ?? null,
                    $row['url_web'] ?? null,
                    $row['id_rol'] ?? null,
                    $id
                );
            }
        } catch (\Throwable $th) {
            error_log("Error en->get(".$id.") Usuarios");
            error_log($th->getMessage());
        }finally{
            $statement = null;
            $pdo = null;
        }
        return $resultado;
    }

    public function login($objeto){
        $sql = "SELECT id, nombre_usuario ,email, id_rol FROM Usuario 
        WHERE nombre_usuario=:usuario AND passw=:passw AND borrado = 0";
        $pdo = Model::getConnection();
        $hash = hash('sha256', $objeto['passw']);
        try {
            $statement = $pdo->prepare($sql);
            $statement->bindValue(':usuario', $objeto["nombre_usuario"], PDO::PARAM_STR);
            $statement->bindValue(':passw', $hash , PDO::PARAM_STR);
            $statement->execute();
            $resultado=$statement->fetch();
        } catch (\PDOException $th) {
            error_log("Error en->login() UsuarioModel");
            error_log($th->getMessage());
            $resultado = $th->getMessage();
        } finally {
            $statement = null;
            $pdo = null;
        }
        return $resultado;
    }

    public function addUser($usuario): bool{
        $resultado= false;
        if ($usuario["tipo_usuario"] == "empresa") {
            $sql = " INSERT INTO Usuario (nombre_usuario, email, passw ,tipo_usuario, nombre_comercial, url_web) VALUES (:nombre_usuario, :email, :passw , :tipo_usuario, :nombre_comercial, :url_web)";
        }else{
            $sql = "INSERT INTO Usuario (nombre_usuario, email, passw ) VALUES (:nombre_usuario, :email, :passw)";
        }

        $pdo = Model::getConnection();
        $hash = hash('sha256', $usuario["password"]);
        
        try {
            $statement = $pdo->prepare($sql);
            $statement->bindValue(':nombre_usuario', $usuario["nombre_usuario"], PDO::PARAM_STR);
            $statement->bindValue(':email', $usuario["email"], PDO::PARAM_STR);
            $statement->bindValue(':passw', $hash, PDO::PARAM_STR);

            if ($usuario["tipo_usuario"] == "empresa") {
                $statement->bindValue(':tipo_usuario', $usuario["tipo_usuario"], PDO::PARAM_STR);
                $statement->bindValue(':nombre_comercial', $usuario["tipo_usuario"], PDO::PARAM_STR);
                $statement->bindValue(':url_web', $usuario["url_web"], PDO::PARAM_STR);
            }
            $resultado = $statement->execute();

        } catch (\PDOException $th) {
            error_log("Error en->addUser() UsuarioModel ".$th->getMessage());
            $resultado = $th->getMessage();
        } finally {
            $statement = null;
            $pdo = null;
        }
        return $resultado;
    }

    public function blockUser($id):bool{
        $resultado= false;
        $sql = "UPDATE Usuario SET borrado = 1 WHERE id = :id";
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

    public function changePassword($id, $objeto):bool{
        $resultado= false;
        $sql = "UPDATE Usuario SET passw = :passw WHERE id = :id";
        $pdo = Model::getConnection();
        $hash = hash('sha256', $objeto['passw']);
        try {
            $statement = $pdo->prepare($sql);
            $statement->bindValue(':id', $id, PDO::PARAM_INT);
            $statement->bindValue(':passw',$hash , PDO::PARAM_STR);
            $statement->execute();
            $resultado=$statement->rowCount()==1;
        } catch (\PDOException $th) {
            error_log("Error en->changePassword($id) UsuarioModel");
            error_log($th->getMessage());

        } finally {
            $statement = null;
            $pdo = null;
            
        }
        
        return $resultado;
    }

    public function updateUser($id,$usuario) : bool {
       
        if ($usuario["tipo_usuario"] == "empresa") {
            $sql = "UPDATE Usuario SET nombre_usuario = :nombre_usuario, email = :email,
                nombre_comercial = :nombre_comercial, url_web = :url_web WHERE id = :id";
        }else{
            $sql = "UPDATE Usuario SET nombre_usuario = :nombre_usuario, email = :email WHERE id = :id";
        }
        $pdo = Model::getConnection();
        $resultado = false;
        try {
            $statement = $pdo->prepare($sql);
            $statement->bindValue(':id', $id, PDO::PARAM_INT);
            $statement->bindValue(':nombre_usuario', $usuario["nombre_usuario"], PDO::PARAM_STR);
            $statement->bindValue(':email', $usuario["email"], PDO::PARAM_STR);

            if ($usuario["tipo_usuario"] == "empresa") {
                $statement->bindValue(':nombre_comercial', $usuario["nombre_comercial"], PDO::PARAM_STR);
                $statement->bindValue(':url_web', $usuario["url_web"], PDO::PARAM_STR);
            }
            $statement->execute();
            $resultado = true;
        } catch (\PDOException $th) {
            error_log("Error en->updateUser($id) UsuarioModel");
            error_log($th->getMessage());
        } finally {
            $statement = null;
            $pdo = null;
        }
        return $resultado;
    }

    public function delete($id) : bool {
        $sql = "DELETE FROM Usuario WHERE id = :id AND id_rol != 1";
        $pdo = Model::getConnection();
        try {
            $statement = $pdo->prepare($sql);
            $statement->bindValue(':id', $id, PDO::PARAM_INT);
            $resultado = $statement->execute();
            return true;
        } catch (\PDOException $th) {
            error_log("Error en->deleteUser($id) UsuarioModel");
            error_log($th->getMessage());
        } finally {
            $statement = null;
            $pdo = null;
        }
        return false;
    }

    public static function getUserByNombre($nombre_usuario) {
        $sql = "SELECT id FROM Usuario Where nombre_usuario = :nombre_usuario";
        $pdo = Model::getConnection();
        try {
            $statement = $pdo->prepare($sql);
            $statement->bindValue(':nombre_usuario', $nombre_usuario, PDO::PARAM_STR);
            $statement->execute();
            $resultado=$statement->rowCount()==1;
        } catch (\PDOException $th) {
            error_log("Error en->getUserByNombre() UsuarioModel");
            error_log($th->getMessage());
        } finally {
            $statement = null;
            $pdo = null;
        }
        return $resultado;
    }
    public static function getUserByEmail($email) {
        $sql = "SELECT id FROM Usuario Where email = :email";
        $pdo = Model::getConnection();
        try {
            $statement = $pdo->prepare($sql);
            $statement->bindValue(':email', $email, PDO::PARAM_STR);
            $statement->execute();
            $resultado=$statement->rowCount()==1;
        } catch (\PDOException $th) {
            error_log("Error en->getUserByEmail() UsuarioModel");
            error_log($th->getMessage());
        } finally {
            $statement = null;
            $pdo = null;
        }
        return $resultado;
    }

}