<?php
include_once("model.php");
class Anuncio extends ModelObject{

    public $id;
    public $titulo;
    public $descripcion;
    public $contenido;
    public $id_tipo_anuncio;
    public $id_categoria;
    public $id_usuario;
    public $id_localidad;
    public $imagen_url;

    public function __construct($id = null,$titulo = null,$descripcion = null,$contenido = null,$id_tipo_anuncio = null,$id_categoria=null, $id_usuario = null,$id_localidad = null,$imagen_url = null){
        $this->titulo = $titulo;
        $this->descripcion = $descripcion;
        $this->contenido = $contenido;
        $this->id_tipo_anuncio = $id_tipo_anuncio;
        $this->id_categoria = $id_categoria;
        $this->id_usuario = $id_usuario;
        $this->id_localidad = $id_localidad;
        $this->imagen_url = $imagen_url;
        $this->id = $id;
    }


    public static function fromJson($json): ModelObject {

        if (is_string($json)) {
            $data = json_decode($json);

            return new Anuncio(
                $data->id ?? null,
                $data->titulo ?? null,
                $data->descripcion ?? null,
                $data->contenido ?? null,
                $data->id_tipo_anuncio ?? null,
                $data->id_categoria ?? null,
                $data->id_usuario ?? null,
                $data->id_localidad ?? null,
                $data->imagen_url ?? null
            );
            
        }else{
            $data = $json;

            return new Anuncio(
                $data['id'] ?? null,
                $data['titulo'] ?? null,
                $data['descripcion'] ?? null,
                $data['contenido'] ?? null,
                $data['id_tipo_anuncio'] ?? null,
                $data['id_categoria'] ?? null,
                $data['id_usuario'] ?? null,
                $data['id_localidad'] ?? null,
                $data['imagen_url'] ?? null
            );
        }
    }

    public function toJson():String{
        return json_encode($this,JSON_PRETTY_PRINT);
    }

}
class AnuncioModel extends Model{
    public function getAll(){

        $sql = "SELECT * FROM Anuncio WHERE borrado = 0 ORDER BY fecha_creacion DESC";
        $pdo = Model::getConnection();
        $resultado = [];
        try {
            $statement = $pdo->query($sql);
            foreach ($statement as $row) {
                $anuncio = new Anuncio(
                    $row['id'],
                    $row['titulo'],
                    $row['descripcion'],
                    $row['contenido'],
                    $row['id_tipo_anuncio'],
                    $row['id_categoria'],
                    $row['id_usuario'],
                    $row['id_localidad'],
                    $row['imagen_url'],
                );
                array_push($resultado, $anuncio);
            }
        } catch (\Throwable $th) {
            error_log("Error en->getAll() Anuncio");
            error_log($th->getMessage());
        }finally{
            $statement = null;
            $pdo = null;
        }
        return $resultado;
    }

    public function get($id){

        $sql = "SELECT * FROM Anuncio WHERE id = :id AND borrado = 0";
        $pdo = Model::getConnection();
        $resultado = null;
        try {
            $statement = $pdo->prepare($sql);
            $statement->bindParam(':id', $id,PDO::PARAM_INT);
            $statement->execute();
            if ($row=$statement->fetch()) {
                $resultado = new Anuncio(
                    $row['id'],
                    $row['titulo'],
                    $row['descripcion'],
                    $row['contenido'],
                    $row['id_tipo_anuncio'],
                    $row['id_categoria'],
                    $row['id_usuario'],
                    $row['id_localidad'],
                    $row['imagen_url']
                );
            }
        } catch (\Throwable $th) {
            error_log("Error en->get($id) Anuncio".$th->getMessage());
            error_log($th->getMessage());
        }finally{
            $statement = null;
            $pdo = null;
        }
        return $resultado;
    }
    public function delete($id){

            $sql = "DELETE FROM Anuncio WHERE id=:id";
            $pdo = Model::getConnection();
            $resultado = null;
        try{
            $statement = $pdo->prepare($sql);
            $statement->bindParam(':id', $id, PDO::PARAM_INT); 
            $resultado = $statement->execute();
            $resultado = $statement->rowCount() == 1;

        } catch (\Throwable $th) {
            error_log("Error en->get($id) Anuncio");
            error_log($th->getMessage());
        }finally{
            $statement = null;
            $pdo = null;
        }
            return $resultado;
    }

    public function update($id, $object):bool{
        $sql = "UPDATE Anuncio SET 
                titulo=:titulo,
                descripcion=:descripcion,
                contenido=:contenido,
                fecha_modificacion=:fecha_modificacion,
                id_tipo_anuncio=:id_tipo_anuncio,
                id_categoria=:id_categoria,
                id_localidad=:id_localidad";
                
        if ($object->imagen_url != null || $object->imagen_url != "") {
            $sql .= ", imagen_url=:imagen_url";
        }

        $sql .= " WHERE id=:id AND borrado = 0";        
        
        $pdo = Model::getConnection();
        $resultado= false;
        $fecha = (new DateTime())->format('Y-m-d H:i:s');
        try{
            $statement = $pdo->prepare($sql);
            $statement->bindParam(':id', $id, PDO::PARAM_INT); 
            $statement->bindValue(':titulo', $object->titulo, PDO::PARAM_STR);
            $statement->bindValue(':descripcion', $object->descripcion, PDO::PARAM_STR);
            $statement->bindValue(':contenido', $object->contenido, PDO::PARAM_STR);
            $statement->bindValue(':fecha_modificacion', $fecha, PDO::PARAM_STR);
            $statement->bindValue(':id_tipo_anuncio', $object->id_tipo_anuncio, PDO::PARAM_INT);
            $statement->bindValue(':id_categoria', $object->id_categoria, PDO::PARAM_INT);
            $statement->bindValue(':id_localidad', $object->id_localidad, PDO::PARAM_INT);

            if ($object->imagen_url != null || $object->imagen_url != "") {
                $statement->bindValue(':imagen_url', $object->imagen_url, PDO::PARAM_STR);
            }
            
            $statement->execute();
            $resultado = $statement->rowCount() == 1;

        } catch (\Throwable $th) {
            error_log("Error en->update($id,".$object->toJson().") Anuncio");
            error_log($th->getMessage());
        }finally{
            $statement = null;
            $pdo = null;
        }
            return $resultado;
    }

    public function insert($object):bool{

        $sql = "INSERT INTO Anuncio (titulo, descripcion, contenido, id_tipo_anuncio, id_categoria, fecha_creacion, fecha_modificacion, id_usuario, id_localidad, imagen_url) 
        values (:titulo, :descripcion, :contenido, :id_tipo_anuncio, :id_categoria,:fecha_creacion, :fecha_modificacion, :id_usuario, :id_localidad, :imagen_url)";

        $pdo = Model::getConnection();

        $fecha = (new DateTime())->format('Y-m-d H:i:s');
        $resultado= false;

        try {
            $statement = $pdo->prepare($sql);
            $statement->bindValue(':titulo', $object->titulo, PDO::PARAM_STR);
            $statement->bindValue(':descripcion', $object->descripcion, PDO::PARAM_STR);
            $statement->bindValue(':contenido', $object->contenido, PDO::PARAM_STR);
            $statement->bindValue(':id_tipo_anuncio', $object->id_tipo_anuncio, PDO::PARAM_INT);
            $statement->bindValue(':id_categoria', $object->id_categoria, PDO::PARAM_INT);
            $statement->bindValue(':fecha_creacion', $fecha , PDO::PARAM_STR);
            $statement->bindValue(':fecha_modificacion', $fecha,PDO::PARAM_STR);
            $statement->bindValue(':id_usuario', $object->id_usuario, PDO::PARAM_INT);
            $statement->bindValue(':id_localidad', $object->id_localidad, PDO::PARAM_INT);
            $statement->bindValue(':imagen_url', $object->imagen_url, PDO::PARAM_STR);

            $resultado = $statement->execute();
            $resultado = $statement->rowCount() == 1;

            $resultado= true;
        } catch (\Throwable $th) {
            error_log("Error en->insert(".$object->toJson()." Anuncio");
            error_log($th->getMessage());
        }finally{
            $statement = null;
            $pdo = null;
        }

        return $resultado;
    }

    public function getByUser($objeto){
        $id_usuario = $objeto["id_usuario"];;

        $sql = "SELECT * FROM Anuncio WHERE id_usuario = :id_usuario AND borrado = 0 ORDER BY fecha_creacion DESC";
        $pdo = Model::getConnection();
        $resultado = [];
        try {
            $statement = $pdo->prepare($sql);
            $statement->bindParam(':id_usuario', $id_usuario,PDO::PARAM_INT);
            $statement->execute();
            foreach ($statement as $row) {
                $anuncio = new Anuncio(
                    $row['id'],
                    $row['titulo'],
                    $row['descripcion'],
                    $row['contenido'],
                    $row['id_tipo_anuncio'],
                    $row['id_categoria'],
                    $row['id_usuario'],
                    $row['id_localidad'],
                    $row['imagen_url'],
                );
                array_push($resultado, $anuncio);
            }
        } catch (\Throwable $th) {
            error_log("Error en->getByUser($id_usuario) Anuncio".$th->getMessage());
            error_log($th->getMessage());
        }finally{
            $statement = null;
            $pdo = null;
        }
        return $resultado;
    }

    public function getByCategoria($id_categoria){

        $sql = "SELECT * FROM Anuncio WHERE id_categoria = :id_categoria AND borrado = 0 ORDER BY fecha_creacion DESC";
        $pdo = Model::getConnection();
        $resultado = [];
        try {
            $statement = $pdo->prepare($sql);
            $statement->bindParam(':id_categoria', $id_categoria,PDO::PARAM_INT);
            $statement->execute();
            foreach ($statement as $row) {
                $anuncio = new Anuncio(
                    $row['id'],
                    $row['titulo'],
                    $row['descripcion'],
                    $row['contenido'],
                    $row['id_tipo_anuncio'],
                    $row['id_categoria'],
                    $row['id_usuario'],
                    $row['id_localidad'],
                    $row['imagen_url'],
                );
                array_push($resultado, $anuncio);
            }
        } catch (\Throwable $th) {
            error_log("Error en->getByCategoria($id_categoria) Anuncio".$th->getMessage());
            error_log($th->getMessage());
        }finally{
            $statement = null;
            $pdo = null;
        }
        return $resultado;
    }

    public static function blockAnuncio($id){

        $sql = "UPDATE Anuncio SET borrado='1' WHERE id=:id";
        $pdo = Model::getConnection();
        $resultado= false;
    try{
        $statement = $pdo->prepare($sql);
        $statement->bindParam(':id', $id, PDO::PARAM_INT); 

        $statement->execute();
        $resultado = $statement->rowCount() == 1;

    } catch (\Throwable $th) {
        error_log("Error en->blockAnuncio($id) Anuncio");
        error_log($th->getMessage());
    }finally{
        
        $statement = null;
        $pdo = null;
    }
        return $resultado;
    }

    public static function deleteAllByUser($id_usuario){
        $sql = "DELETE FROM Anuncio WHERE id_usuario=:id_usuario";
        $pdo = Model::getConnection();
        $resultado = null;
        try{
            $statement = $pdo->prepare($sql);
            $statement->bindParam(':id_usuario', $id_usuario, PDO::PARAM_INT); 
            $resultado = $statement->execute();
            $resultado = $statement->rowCount() >= 0;
        } catch (\Throwable $th) {
            error_log("Error en->deleteAllByUser($id_usuario) Anuncio");
            error_log($th->getMessage());
        }finally{
            $statement = null;
            $pdo = null;
        }
        return $resultado;

    }

}