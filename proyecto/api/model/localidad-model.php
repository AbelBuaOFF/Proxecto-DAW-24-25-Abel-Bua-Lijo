<?php
include_once("model.php");
class Localidad extends ModelObject{

    public int $id;
    public string $nombre_localidad;
    public int $id_provincia;
    public string $cofigo_postal;

    public function __construct($id = null, $nombre_localidad = null, $id_provincia = null, $cofigo_postal = null){
        $this->id = $id;
        $this->nombre_localidad = $nombre_localidad;
        $this->id_provincia = $id_provincia;
        $this->cofigo_postal = $cofigo_postal;
    }

    public static function fromJson($json): ModelObject {
            $data = $json;

            return new Localidad(
                $data['id'] ?? null,
                $data['nombre_localidad'] ?? null,
                $data['id_provincia'] ?? null,
                $data['cofigo_postal'] ?? null
            );
        
    }

    public function toJson():String{
        return json_encode($this,JSON_PRETTY_PRINT);
    }


    /**
     * Get the value of id
     */ 
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set the value of id
     *
     * @return  self
     */ 
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Get the value of nombre_localidad
     */ 
    public function getNombre_localidad()
    {
        return $this->nombre_localidad;
    }

    /**
     * Set the value of nombre_localidad
     *
     * @return  self
     */ 
    public function setNombre_localidad($nombre_localidad)
    {
        $this->nombre_localidad = $nombre_localidad;

        return $this;
    }

    /**
     * Get the value of id_provincia
     */ 
    public function getId_provincia()
    {
        return $this->id_provincia;
    }

    /**
     * Set the value of id_provincia
     *
     * @return  self
     */ 
    public function setId_provincia($id_provincia)
    {
        $this->id_provincia = $id_provincia;

        return $this;
    }

    /**
     * Get the value of cofigo_postal
     */ 
    public function getCofigo_postal()
    {
        return $this->cofigo_postal;
    }

    /**
     * Set the value of cofigo_postal
     *
     * @return  self
     */ 
    public function setCofigo_postal($cofigo_postal)
    {
        $this->cofigo_postal = $cofigo_postal;

        return $this;
    }
}
class LocalidadModel extends Model{

    public function getAll(){

        $sql = "SELECT * FROM Localidad";
        $pdo = Model::getConnection();
        $resultado = [];
        try {
            $statement = $pdo->query($sql);
            foreach ($statement as $row) {
                $anuncio = new Localidad(
                    $row['id'],
                    $row['nombre_localidad'],
                    $row['id_provincia'],
                    $row['codigo_postal']
                );
                array_push($resultado, $anuncio);
            }
        } catch (\Throwable $th) {
            error_log("Error en->getAll() Localidad");
            error_log($th->getMessage());
        }finally{
            $statement = null;
            $pdo = null;
        }
        return $resultado;
    }

    public function get($id){
        $sql = "SELECT * FROM Localidad Where id=:id";
        $pdo = Model::getConnection();
        $resultado = [];
        try {
            $statement = $pdo->prepare($sql);
            $statement->bindParam(':id', $id, PDO::PARAM_INT);
            $statement->execute();
            foreach ($statement as $row) {
                $anuncio = new Localidad(
                    $row['id'],
                    $row['nombre_localidad'],
                    $row['id_provincia'],
                    $row['codigo_postal']
                );
                array_push($resultado, $anuncio);
            }
        } catch (\Throwable $th) {
            error_log("Error en->get($id) Localidad");
            error_log($th->getMessage());
        }finally{
            $statement = null;
            $pdo = null;
        }
        return $resultado;
    }

}