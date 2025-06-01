<?php
include_once("model.php");
class TipoAnuncio extends ModelObject{
    public int $id;
    public string $nombre_tipo_anuncio;

    public function __construct($id=null,$tipo_anuncio=null)
    {
        $this->id = $id;
        $this->nombre_tipo_anuncio = $tipo_anuncio;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function getTipoAnuncio(): string
    {
        return $this->nombre_tipo_anuncio;
    }

    public function setTipoAnuncio(string $nombre_tipo_anuncio): void
    {
        $this->nombre_tipo_anuncio = $nombre_tipo_anuncio;
    }

    public static function fromJson($json): TipoAnuncio
    {
        $data = $json;
        return new TipoAnuncio(
            $data['id'] ?? null,
            $data['nombre_tipo_anuncio'] ?? null,
        );
    }    

    public function toJson():String{
        return json_encode($this,JSON_PRETTY_PRINT);
    }

}
class TipoAnuncioModel extends Model{

    public function getAll(){

        $sql = "SELECT * FROM Tipo_Anuncio";
        $pdo = Model::getConnection();
        $resultado = [];
        try {
            $statement = $pdo->query($sql);
            
            foreach ($statement as $row) {
                
                $tanuncio = new TipoAnuncio(
                    $row['id'],
                    $row['nombre_tipo_anuncio'],
                );
                array_push($resultado, $tanuncio);
            }
        } catch (\Throwable $th) {
            error_log("Error en->getAll() Tipo_Anuncio");
            error_log($th->getMessage());
        }finally{
            $statement = null;
            $pdo = null;
        }
        return $resultado;

    }
    public function get($id){

        $sql = "SELECT * FROM Tipo_Anuncio WHERE id = :id";
        $pdo = Model::getConnection();
        $resultado = null;
        try {
            $statement = $pdo->prepare($sql);
            $statement->bindParam(':id', $id,PDO::PARAM_INT);
            $statement->execute();
            echo $statement->rowCount();
            if ($row=$statement->fetch()) {
                $resultado = new TipoAnuncio(
                    $row['id'],
                    $row['nombre_tipo_anuncio'],
                );
            }
        } catch (\Throwable $th) {
            error_log("Error en->get($id) Tipo_Anuncio".$th->getMessage());
            error_log($th->getMessage());
        }finally{
            $statement = null;
            $pdo = null;
        }
        return $resultado;


    }
    public function delete($id){

        $sql = "DELETE FROM Tipo_Anuncio WHERE id=:id";
        $pdo = Model::getConnection();
        $resultado = null;
    try{
        $statement = $pdo->prepare($sql);
        $statement->bindParam(':id', $id, PDO::PARAM_INT); 
        $resultado = $statement->execute();
        $resultado = $statement->rowCount() == 1;

    } catch (\Throwable $th) {
        error_log("Error en->get($id) delete");
        error_log($th->getMessage());
    }finally{
        $statement = null;
        $pdo = null;
    }
        return $resultado;

    }
    public function insert($object):bool{
        $sql = "INSERT INTO Tipo_Anuncio (nombre_tipo_anuncio)
        values (:nombre_tipo_anuncio)";
        $pdo = Model::getConnection();
        $resultado= false;

        try {
            $statement = $pdo->prepare($sql);
            $statement->bindValue(':nombre_tipo_anuncio', $object->nombre_tipo_anuncio, PDO::PARAM_STR);

            $resultado = $statement->execute();
            $resultado = $statement->rowCount() == 1;

            $resultado= true;
        } catch (\Throwable $th) {
            error_log("Error en->insert(".$object->toJson()." tipo_anuncio");
            error_log($th->getMessage());
        }finally{
            $statement = null;
            $pdo = null;
        }

        return $resultado;

    }
    public function update($id, $object){

        $sql = "UPDATE Tipo_Anuncio SET 
        nombre_tipo_anuncio=:nombre_tipo_anuncio,
        WHERE id=:id";
        $pdo = Model::getConnection();
        $resultado= false;
        try{
        $statement = $pdo->prepare($sql);
        $statement->bindValue(':nombre_tipo_anuncio', $object->nombre_tipo_anuncio, PDO::PARAM_STR);

        $resultado = $statement->execute();
        $resultado = $statement->rowCount() == 1;

        $resultado= true;

        } catch (\Throwable $th) {
            error_log("Error en->update($id,".$object->toJson().") ipo_anuncio");
            error_log($th->getMessage());
        }finally{
            $statement = null;
            $pdo = null;
        }
            return $resultado;

    }
}