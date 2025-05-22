<?php
include_once("model.php");
class Anuncio extends ModelObject{

    public $id;
    public $titulo;
    public $descripcion;
    public $contenido;
    public $id_tipo_anuncio;
    public $fecha_creacion;
    public $fecha_modificacion;
    public $id_usuario;
    public $id_localidad;
    public $imagen_url;
    public $borrado;

    public function __construct(
        $id,
        $titulo,
        $descripcion,
        $contenido,
        $id_tipo_anuncio,
        $fecha_creacion,
        $fecha_modificacion,
        $id_usuario,
        $id_localidad,
        $imagen_url,
        $borrado = false
    ) {
        $this->id = $id;
        $this->titulo = $titulo;
        $this->descripcion = $descripcion;
        $this->contenido = $contenido;
        $this->id_tipo_anuncio = $id_tipo_anuncio;
        $this->fecha_creacion = $fecha_creacion;
        $this->fecha_modificacion = $fecha_modificacion;
        $this->id_usuario = $id_usuario;
        $this->id_localidad = $id_localidad;
        $this->imagen_url = $imagen_url;
        $this->borrado = $borrado;
    }

    public static function fromJson($json): ModelObject {
        $data = json_decode($json);
        return new Anuncio(
            $data->id ?? null,
            $data->titulo ?? null,
            $data->descripcion ?? null,
            $data->contenido ?? null,
            $data->id_tipo_anuncio ?? null,
            $data->fecha_creacion ?? null,
            $data->fecha_modificacion ?? null,
            $data->id_usuario ?? null,
            $data->id_localidad ?? null,
            $data->imagen_url ?? null,
            $data->borrado ?? false
        );
    }


    public function toJson():String{
        return json_encode($this,JSON_PRETTY_PRINT);
    }

}
class AnuncioModel extends Model{
    public function getAll(){

        $sql = "SELECT * FROM Anuncio";
        $pdo = Model::getConnection();
        $resultado = [];
        try {
            $statement = $pdo->query($sql);
            $resultado = array();
            foreach ($statement as $row) {
                $anuncio = new Anuncio(
                    $row['id'],
                    $row['titulo'],
                    $row['descripcion'],
                    $row['contenido'],
                    $row['id_tipo_anuncio'],
                    $row['fecha_creacion'],
                    $row['fecha_modificacion'],
                    $row['id_usuario'],
                    $row['id_localidad'],
                    $row['imagen_url'],
                    $row['borrado']
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
        $resultado = null;

        return $resultado;
    }
    public function delete($id){
        $resultado = null;
        return $resultado;
    }

    public function update($id, $object){
        $resultado = null;

        return $resultado;
    }

    public function insert($object){
        $resultado = null;

        return $resultado;
    }

    
}