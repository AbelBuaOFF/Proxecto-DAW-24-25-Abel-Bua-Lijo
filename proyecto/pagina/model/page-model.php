<?php
namespace webautoriza\model;
use PDO;
use PDOException;
define('DB_DSN','mysql:host=mariadb;dbname=control_acceso');
define('DB_USER','root');
define('DB_PASS','bitnami');

class PageModel{
    protected static function getConexion():PDO{
        try{
            $pdo = new PDO(DB_DSN,DB_USER, DB_PASS);
        }catch(PDOException $th){
            error_log('Error de conexion con la BD: '.$th->getMessage());
            die();
        }
        return $pdo;
    }
}