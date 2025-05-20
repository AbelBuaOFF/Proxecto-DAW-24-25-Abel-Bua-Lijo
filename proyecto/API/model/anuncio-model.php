<?php
include_once("Model.php");
include_once("ModelObject.php");
class Anuncio extends ModelObject{

    private $id;
    private $titulo;
    private $descripcion;
    private $fecha_publicacion;
    private $usuario_id;
    private $categoria_id;

    public function __construct($id, $titulo, $descripcion, $fecha_publicacion, $usuario_id, $categoria_id)
    {
        parent::__construct();
        $this->id = $id;
        $this->titulo = $titulo;
        $this->descripcion = $descripcion;
        $this->fecha_publicacion = $fecha_publicacion;
        $this->usuario_id = $usuario_id;
        $this->categoria_id = $categoria_id;
    }

    public static function fromJson($json):ModelObject{
        $data = json_decode($json);
        return new Anuncio($data->id, $data->titulo, $data->descripcion, $data->fecha_publicacion, $data->usuario_id, $data->categoria_id);
    }


    public function toJson():String{
        return json_encode($this,JSON_PRETTY_PRINT);
    }

    public function getAll(){

        $sql = "SELECT * FROM banda";
        $pdo = Model::get();
        $resultado = [];

        try {
            //code...
        } catch (\Throwable $th) {
            //throw $th;
        }finally{
            
        }

    }
}