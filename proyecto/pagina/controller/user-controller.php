<?php

include_once("page-controller.php");
include_once(PATH_MODEL."solicitud-model.php");
class UserController extends PageController{

    public function __construct()
    {
        parent::__construct();
    }

    public static function home(){
        $vista = new View;
        $data = [];

        $token = UserController::verificarToken();


        if (isset($token->fecha_expiracion)) {
            if ($token->fecha_expiracion < date("Y-m-d H:i:s")) {
                session_destroy();
                $vista->show("login",["error" => "Token expirado, por favor inicie sesión de nuevo."]);
            }
        }
        
        $vista->show("home",$data);
    }

    public function userPage($id_usuario){
        $vista = new View;
        $data = [];

        $solicitud = new Solicitud("usuario","get",$id_usuario, null);
        $model = new SolicitudModel();
        $data["usuario"]=  (object)  $model->enviarSolicitud($solicitud);

        $vista->show("user", $data);
    }

    public static function addUser(){
        $vista = new View;

        var_dump($_POST);
        if (isset($_POST['nombre_usuario']) && isset($_POST['email']) && isset($_POST['password'])) {
            $data = new stdClass();
                $data->nombre_usuario = $_POST['nombre_usuario'];
                $data->email = $_POST['email'];
                $data->passw = $_POST['password'];

            if (isset($_POST['tipo_usuario'])&& isset($_POST['nombre_comercial']) && isset($_POST['url_web'])) {
                $data->tipo_usuario = "empresa";
                $data->nombre_comercial = $_POST['nombre_comercial'];
                $data->url_web = $_POST['url_web'];
            }

            $solicitud = new Solicitud("usuario","addUser",null, $data);
            $model = new SolicitudModel();
            $respuesta = $model->enviarSolicitud($solicitud);
            var_dump($respuesta);

            if ($respuesta->status == "success") {
             //  header("Location: /pagina/index.php?controller=MainController&action=login");
            }

        }else{
            $error = ["error" => "Error al registrar usuario"];
            $vista->show("registro",$error);
        }  
        
    }

    public static function userLogin(){
        $vista = new View;
        if (isset($_POST['nombre_usuario']) && isset($_POST['password'])) {
        $data = new stdClass();
            $data->nombre_usuario = $_POST['nombre_usuario'];
            $data->passw = $_POST['password'];

        $solicitud = new Solicitud("usuario","login",null, $data);
        $model = new SolicitudModel();
        $data = $model->enviarSolicitud($solicitud);
        if (isset($data["status"]) && $data["status"] == "success") {
            session_start();
            $_SESSION['token'] = $data["token"];
            $_SESSION['id_usuario'] = $data["id_usuario"];

            header("Location: /pagina/index.php?controller=UserController&action=home");

        }
        $vista->show("login",$data);

        }else{
            $respuesta = ["error"];
            $vista->show("login",$respuesta);
        }
    
    }

    public static function Logout(){
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        session_unset(); 
        session_destroy();
        header("Location: /pagina/index.php?controller=MainController&action=index");
    }

    public static function verificarToken(){
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        $data = new stdClass();
        $data->id_usuario = $_SESSION['id_usuario'];
        $solicitud = new Solicitud("token","get",null, $data);
        $model = new SolicitudModel();
        $resultado = $model->enviarSolicitud($solicitud);
        return $resultado;
    }

}

