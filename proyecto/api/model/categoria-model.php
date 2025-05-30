<?php
include_once("model.php");
class Categoria extends ModelObject{
    public int $id;
    public string $nombre_categoria;

    public function __construct($id=null,$nombre_categoria=null)
    {
        $this->id = $id;
        $this->nombre_categoria = $nombre_categoria;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function getNombreCategoria(): string
    {
        return $this->nombre_categoria;
    }

    public function setNombreCategoria(string $nombre_categoria): void
    {
        $this->nombre_categoria = $nombre_categoria;
    }

    public static function fromJson($json): Categoria
    {
        $data = $json;
        return new Categoria(
            $data['id'] ?? null,
            $data['nombre_categoria'] ?? null,
        );
    }    

    public function toJson():String{
        return json_encode($this,JSON_PRETTY_PRINT);
    }

}
class CategoriaModel extends Model{

    public function getAll(){

        $sql = "SELECT * FROM Categoria";
        $pdo = Model::getConnection();
        $resultado = [];
        try {
            $statement = $pdo->query($sql);
            
            foreach ($statement as $row) {
                
                $categoria = new Categoria(
                    $row['id'],
                    $row['nombre_categoria'],
                );
                array_push($resultado, $categoria);
            }
        } catch (\Throwable $th) {
            error_log("Error en->getAll() Categoria");
            error_log($th->getMessage());
        }finally{
            $statement = null;
            $pdo = null;
        }
        return $resultado;

    }
    public function get($id){

        $sql = "SELECT * FROM Categoria WHERE id = :id";
        $pdo = Model::getConnection();
        $resultado = null;
        try {
            $statement = $pdo->prepare($sql);
            $statement->bindParam(':id', $id,PDO::PARAM_INT);
            $statement->execute();
            echo $statement->rowCount();
            if ($row=$statement->fetch()) {
                $resultado = new Categoria(
                    $row['id'],
                    $row['nombre_categoria'],
                );
            }
        } catch (\Throwable $th) {
            error_log("Error en->get($id) Categoria".$th->getMessage());
            error_log($th->getMessage());
        }finally{
            $statement = null;
            $pdo = null;
        }
        return $resultado;


    }
    public function delete($id){

        $sql = "DELETE FROM Categoria WHERE id=:id";
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
        $sql = "INSERT INTO Categoria (nombre_categoria)
        values (:nombre_categoria)";
        $pdo = Model::getConnection();
        $resultado= false;

        try {
            $statement = $pdo->prepare($sql);
            $statement->bindValue(':nombre_categoria', $object->nombre_categoria, PDO::PARAM_STR);

            $resultado = $statement->execute();
            $resultado = $statement->rowCount() == 1;

            $resultado= true;
        } catch (\Throwable $th) {
            error_log("Error en->insert(".$object->toJson()." Categoria");
            error_log($th->getMessage());
        }finally{
            $statement = null;
            $pdo = null;
        }

        return $resultado;

    }
    public function update($id, $object){

        $sql = "UPDATE Categoria SET 
        nombre_categoria=:nombre_categoria,
        WHERE id=:id";
        $pdo = Model::getConnection();
        $resultado= false;
        try{
        $statement = $pdo->prepare($sql);
        $statement->bindValue(':nombre_categoria', $object->nombre_categoria, PDO::PARAM_STR);

        $resultado = $statement->execute();
        $resultado = $statement->rowCount() == 1;

        $resultado= true;

        } catch (\Throwable $th) {
            error_log("Error en->update($id,".$object->toJson().") Categoria");
            error_log($th->getMessage());
        }finally{
            $statement = null;
            $pdo = null;
        }
            return $resultado;

    }
}