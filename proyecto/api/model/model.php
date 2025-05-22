<?php
define("dsn","mysql:host=mariadb;dbname=el_tablon_digital");
define("user","root");
define("pass","bitnami");

class Model{
    private static $pdo;

    public static function getConnection(){
        if(!isset(self::$pdo)){
            try {
                self::$pdo = new PDO(dsn, user, pass);
            } catch (PDOException $th) {
                error_log($th->getMessage());
            }
        }
        
        return self::$pdo;
    }
}

abstract class ModelObject{
    abstract static  public function fromJson($json):ModelObject;
    abstract public function toJson():String;
}