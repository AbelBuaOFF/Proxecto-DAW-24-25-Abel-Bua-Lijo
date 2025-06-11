<?php
include_once("model.php");
class AuthToken extends ModelObject{

    public $id;
    public $id_usuario;
    public $token;
    public $fecha_expiracion;

    public function __construct($id_usuario = null, $token = null,$fecha_expiracion = null,$id = null,){
        
        $this->id_usuario = $id_usuario;
        $this->token = $token;
        $this->fecha_expiracion = $fecha_expiracion;
        $this->id = $id;
    }

    public static function fromJson($json): ModelObject {

        $data = $json;
        return new AuthToken(
            $data['id_usuario']?? null,
            $data['token'] ?? null,
            $data['fecha_expiracion'] ?? null,
            $data['activo'] ?? null,
            $data['id'] ?? null
        );  
    }

    public function toJson():String{
        return json_encode($this,JSON_PRETTY_PRINT);
    }
}
class AuthTokenModel extends Model{

    public function generateToken($id_usuario){

        //Generar Token
        $bytes = random_bytes(16);
        $token = bin2hex($bytes);

        $sql = "INSERT INTO AuthToken (id_usuario,token,fecha_expiracion) 
                VALUES (:id_usuario,:token,:fecha_expiracion)";
        $pdo = Model::getConnection();

        $fecha = (new DateTime())->format('Y-m-d H:i:s');
        $fecha_exp = date('Y-m-d H:i:s', strtotime('+1 hour', strtotime($fecha)));
        $resultado = new stdClass();
        try {
            $statement = $pdo->prepare($sql);
            $statement->bindValue(':id_usuario', $id_usuario, PDO::PARAM_INT);
            $statement->bindValue(':token', $token, PDO::PARAM_STR);
            $statement->bindValue(':fecha_expiracion', $fecha_exp, PDO::PARAM_STR);
            $statement->execute();
            $resultado->token = $token;
            $resultado->fecha_expiracion = $fecha_exp;
        } catch (\Throwable $th) {
            error_log("Error en->generateToken(".$id_usuario.") AuthToken");
            error_log($th->getMessage());
            $resultado = null;
        }finally{
            $statement = null;
            $pdo = null;
        }
        return $resultado;
    }

    /*
        Recupera un token por id usuario.
    */
    public function getToken($id_usuario){
        $sql = "SELECT id,id_usuario, token, fecha_expiracion FROM AuthToken Where id_usuario=:id_usuario";
        $pdo = Model::getConnection();
        $resultado = [];
        try {
            $statement = $pdo->prepare($sql);
            $statement->bindValue(':id_usuario', $id_usuario, PDO::PARAM_INT);
            $statement->execute();
            if ($row=$statement->fetch()) {
                $resultado = new AuthToken(
                    $row['id_usuario'] ?? null,
                    $row['token'] ?? null,
                    $row['fecha_expiracion'] ?? null,
                    $row['id'] ?? null
                );
            }
        } catch (\Throwable $th) {
            error_log("Error en->get(".$id_usuario.") AuthToken");
            error_log($th->getMessage());
        }finally{
            $statement = null;
            $pdo = null;
        }
        return $resultado;
    }

    public function borrarToken($id_usuario):bool{

        $sql = "DELETE FROM AuthToken where id_usuario = :id_usuario";
        $pdo = Model::getConnection();
        $resultado = false;
        try {
            $statement = $pdo->prepare($sql);
            $statement->bindValue(':id_usuario', $id_usuario);
            $statement->execute();
            $resultado = $statement->rowCount() == 1;
        } catch (\Throwable $th) {
            error_log("Error en->borrarToken() AuthToken");
            error_log($th->getMessage());
        }finally{
            $statement = null;
            $pdo = null;
        }
        return $resultado;
    }

}