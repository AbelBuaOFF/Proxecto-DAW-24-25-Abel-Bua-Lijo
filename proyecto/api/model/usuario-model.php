<?php
include_once("model.php");
class Usuario extends ModelObject{

    public $id;
    public $nombre_usuario;
    public $email;
    public $password;
    public $id_rol;
    public $tipo_usuario;       
    public $nombre_comercial;   
    public $url_web;            

    public function __construct($id = null, $nombre_usuario = null, $email = null,
    $password = null, $id_rol = null, $tipo_usuario = null, 
    $nombre_comercial = null, $url_web = null) {
        
        $this->nombre_usuario = $nombre_usuario;
        $this->email = $email;
        $this->id_rol = $id_rol;
        $this->password = $password;
        $this->id = $id;
        $this->tipo_usuario = $tipo_usuario;
        $this->nombre_comercial = $nombre_comercial;
        $this->url_web = $url_web;
    }

    public static function fromJson($json): ModelObject {

        if (is_string($json)) {
            $data = json_decode($json);
            return new Usuario(
                $data->id ?? null,
                $data->nombre_usuario ?? null,
                $data->email ?? null,
                $data->password ?? null,
                $data->id_rol ?? null,
                $data->tipo_usuario ?? null,
                $data->nombre_comercial ?? null,
                $data->url_web ?? null
            );
        }else{
            $data = $json;
            return new Usuario(
                $data['id']?? null,
                $data['nombre_usuario'] ?? null,
                $data['email'] ?? null,
                $data['password'] ?? null,
                $data['id_rol'] ?? null,
                $data['tipo_usuario'] ?? null,
                $data['nombre_comercial'] ?? null,
                $data['url_web'] ?? null
            );
        }   
    }

    public function toJson():String{
        return json_encode($this,JSON_PRETTY_PRINT);
    }
}
class UsuarioModel extends Model{

    public function getAll() {
        $sql = "SELECT id, nombre_usuario, email,id_rol,tipo_usuario,nombre_comercial,url_web  FROM Usuario Where borrado = 0";
        $pdo = Model::getConnection();
        $resultado = [];
        
        try {
            $statement = $pdo->query($sql);
            foreach ($statement as $row) {
                $anuncio = new Usuario(
                    $row['id']?? null,
                    $row['nombre_usuario'] ?? null,
                    $row['email'] ?? null,
                    null,
                    $row['id_rol'] ?? null,
                    $row['tipo_usuario'] ?? null,
                    $row['nombre_comercial'] ?? null,
                    $row['url_web'] ?? null
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
        $sql = "SELECT nombre_usuario, email, id_rol,tipo_usuario,nombre_comercial,url_web  FROM Usuario Where id=:id AND borrado = 0";
        $pdo = Model::getConnection();
        $resultado = [];
        try {
            $statement = $pdo->query($sql);
            foreach ($statement as $row) {
                $anuncio = new Usuario(
                    null,
                    $row['nombre_usuario'] ?? null,
                    $row['email'] ?? null,
                    null,
                    $row['id_rol'] ?? null,
                    $row['tipo_usuario'] ?? null,
                    $row['nombre_comercial'] ?? null,
                    $row['url_web'] ?? null
                );
                array_push($resultado, $anuncio);
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
        $usuario = false;
        
        try {
            $statement = $pdo->prepare($sql);
            $statement->bindValue(':usuario', $objeto["nombre_usuario"], PDO::PARAM_STR);
            $statement->bindValue(':passw', $hash , PDO::PARAM_STR);
            $statement->execute();
            $usuario = $statement->fetch(PDO::FETCH_ASSOC);
        } catch (\PDOException $th) {
            error_log("Error en->login() UsuarioModel");
            error_log($th->getMessage());
        } finally {
            $statement = null;
            $pdo = null;
        }

        return $usuario;
    }

    public function addUser($usuario): bool{
        $resultado= false;
        $sql = "INSERT INTO Usuario (nombre_usuario, email, passw";

        if ($usuario->tipo_usuario == "empresa") {
            $sql = $sql. ", id_rol, tipo_usuario, nombre_comercial, url_web) "."VALUES (:nombre_usuario, :email, :passw, 2, :tipo_usuario, :nombre_comercial, :url_web)";
        }else{
            $sql = $sql. ") VALUES (:nombre_usuario, :email, :passw)";
        }

        $pdo = Model::getConnection();
        $hash = hash('sha256', $usuario->password);
        
        try {
            $statement = $pdo->prepare($sql);
            $statement->bindValue(':nombre_usuario', $usuario->nombre_usuario, PDO::PARAM_STR);
            $statement->bindValue(':email', $usuario->email, PDO::PARAM_STR);
            $statement->bindValue(':passw', $hash, PDO::PARAM_STR);

            if ($usuario->tipo_usuario == "empresa") {
                $statement->bindValue(':tipo_usuario', $usuario->tipo_usuario, PDO::PARAM_STR);
                $statement->bindValue(':nombre_comercial', $usuario->nombre_comercial, PDO::PARAM_STR);
                $statement->bindValue(':url_web', $usuario->url_web, PDO::PARAM_STR);
            }

            $resultado = $statement->execute();
        } catch (\PDOException $th) {
            error_log("Error en->addUser() UsuarioModel ".$th->getMessage());

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

    public function updateUser() : bool {
        //TODO
        return false;
    }
}