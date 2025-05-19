<?php
define("dsn","mysql:host=mariadb;dbname=el_tablon_digital");
define("user","root");
define("pass","bitnami");

class ConnectionDB{
    private static $pdo;

    public static function get(){
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