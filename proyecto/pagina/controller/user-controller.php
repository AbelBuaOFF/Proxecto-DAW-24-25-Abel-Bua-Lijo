<?php

include_once("page-controller.php");
include_once(PATH_MODEL."solicitud-model.php");
class UserController extends PageController{

    public function __construct()
    {
        parent::__construct();
    }

    public static function home(){
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        $vista = new View;
        $data = [];

        $solicitud = new Solicitud("categoria","getAll");
        $model = new SolicitudModel();
        $data['categorias'] = $model->enviarSolicitud($solicitud);
        
        $solicitud = new Solicitud("localidad","getAll");
        $model = new SolicitudModel();
        $data['localidades'] = $model->enviarSolicitud($solicitud);

        $id_usuario = $_SESSION['id_usuario'];

        if (UserController::checkToken($id_usuario)) {
            header("Location: /pagina/index.php?controller=MainController&action=login&error=1");
        }
        $vista->show("home",$data);
    }

    public function userPage($id_usuario){
        $vista = new View;
        $data = [];

        if (UserController::checkToken($id_usuario)) {
            header("Location: /pagina/index.php?controller=MainController&action=login&error=1");
        }

        $solicitud = new Solicitud("usuario","get",$id_usuario, null);
        $model = new SolicitudModel();
        $data["usuario"]=  (object)  $model->enviarSolicitud($solicitud);

        $vista->show("user", $data);
    }

    public static function addUser(){
        $vista = new View;

        if (isset($_POST['nombre_usuario']) && isset($_POST['email']) && isset($_POST['password'])) {
            $objeto = new stdClass();
                $objeto->nombre_usuario = htmlspecialchars(strip_tags(trim($_POST['nombre_usuario'])));
                $objeto->email = filter_var(trim($_POST['email']),FILTER_SANITIZE_EMAIL);
                $objeto->password = $_POST['password'];

            if (isset($_POST['tipo_usuario'])&& isset($_POST['nombre_comercial']) && isset($_POST['url_web'])) {
                $objeto->tipo_usuario = "empresa";
                $objeto->nombre_comercial = htmlspecialchars(strip_tags(trim($_POST['nombre_comercial'])));
                $objeto->url_web = filter_var(trim($_POST['url_web']),FILTER_SANITIZE_URL);
            }

            $errores= UserController::validarUsuario($objeto);
            if(!empty($errores)){

                $data["errors"]= $errores;
                $vista->show("registro",$data);
                exit;

            }

            $solicitud = new Solicitud("usuario","addUser",null, $objeto);
            $model = new SolicitudModel();

            $data = $model->enviarSolicitud($solicitud);
            if ($data["status"] == "success") {
                header("Location: /pagina/index.php?controller=MainController&action=login");
            }
            $vista->show("registro",$data);
        }else{
            $data['error'] =  ["error" => "Error al registrar usuario"];
            $vista->show("registro",$data);
        }   
    }

    public static function validarUsuario($objeto){

        $errores=[];

        if (strlen($objeto->nombre_usuario) < 5) {
            $errores[]="El nombre de usuario al menos necesita 5 caracteres.";
        }
        if (!filter_var($objeto->email,FILTER_VALIDATE_EMAIL)){
            $errores[]="Emial no valido.";
        }
        if (strlen($objeto->password)< 6) {
            $errores[]="La contraseña al menos necesita 6 caracteres.";
        }else{
            $rex = '/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[\W_])\S+$/';

            if (!preg_match($rex,$objeto->password)) {
                $errores[]="La contraseña debe tener: 1 Mayuscula ,";
                $errores[]="1 minuscula, 1 número ,";
                $errores[]="1 caracter especial y no tener espacios.";
            }
        }

        return $errores;
    }

    public static function userLogin(){
        $vista = new View;
        if (isset($_POST['nombre_usuario']) && isset($_POST['password'])) {
        $objeto = new stdClass();
            $objeto->nombre_usuario = htmlspecialchars(strip_tags(trim($_POST['nombre_usuario'])));;
            $objeto->passw = $_POST['password'];

        $solicitud = new Solicitud("usuario","login",null, $objeto);
        $model = new SolicitudModel();
        $data = $model->enviarSolicitud($solicitud);
        if (isset($data["status"]) && $data["status"] == "success") {
            session_start();
            $_SESSION['token'] = $data["token"];
            $_SESSION['id_usuario'] = $data["id_usuario"];
            $_SESSION['rol'] = $data["id_rol"];
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
    
    public static function updateUserPage($id){
        $vista = new View;
        $data = [];

        if (UserController::checkToken($id)) {
            header("Location: /pagina/index.php?controller=MainController&action=login&error=1");
        }
        
        $solicitud = new Solicitud("usuario","get",$id, null);
        $model = new SolicitudModel();
        $data["usuario"]=  (object)  $model->enviarSolicitud($solicitud);

        $vista->show("update-usuario", $data);
    }

    public static function updateUser(){
        $vista = new View;

        if (session_status() === PHP_SESSION_NONE) {
            session_start();
            $id = $_SESSION['id_usuario'];
        }

        if (isset($_POST['nombre_usuario']) && isset($_POST['email'])&& isset($_POST['tipo_usuario'])) {
            $objeto = new stdClass();
                $objeto->id = $id;
                $objeto->nombre_usuario = htmlspecialchars(strip_tags(trim($_POST['nombre_usuario'])));
                $objeto->email = filter_var(trim($_POST['email']));
                $objeto->tipo_usuario = $_POST['tipo_usuario'];
            if (isset($_POST['nombre_comercial']) && isset($_POST['url_web'])) {
                $objeto->nombre_comercial = htmlspecialchars(strip_tags(trim($_POST['nombre_comercial'])));
                $objeto->url_web = filter_var(trim($_POST['url_web']));
            }
            $solicitud = new Solicitud("usuario","update",$id, $objeto);
            $model = new SolicitudModel();

            $data = $model->enviarSolicitud($solicitud);
            if ($data["status"] == "success") {
                header("Location: /pagina/index.php?controller=MainController&action=home");
            }
            $vista->show("registro",$data);
        }else{
            $data = [];
            $solicitud = new Solicitud("usuario","get",$id, null);
            $model = new SolicitudModel();
            $data["usuario"]=  (object)  $model->enviarSolicitud($solicitud);

            $data['error'] =  ["error" => "Error al actualizar usuario"];
            $vista->show("update-usuario",$data);
        }   
    }

    public static function changePassPage() {
        $vista = new View;
        $data = [];

        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        $id = $_SESSION['id_usuario'];

        $solicitud = new Solicitud("usuario","get",$id, null);
        $model = new SolicitudModel();
        $data["usuario"]=  (object)  $model->enviarSolicitud($solicitud);

        $vista->show("change-passw", $data);
    }

    public static function changePass(){
        $vista = new View;
        $data = [];

        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        if (isset($_POST['ant_password']) &&
            isset($_POST['new_password']) &&
            isset($_POST['repeat_password']) &&
            isset($_POST['nombre_usuario'])) {
            
            $newpassword = $_POST['new_password'];
            $repeatpassword = $_POST['repeat_password'];

            if ($newpassword !== $repeatpassword) {
                header("Location: /pagina/index.php?controller=UserController&action=changePassPage&error=1");
                exit;
            }

            $id = $_SESSION['id_usuario'];

            $login = new stdClass();
                $login->nombre_usuario = $_POST['nombre_usuario'];
                $login->passw = $_POST['ant_password'];
    
            $solicitud = new Solicitud("usuario","login",null, $login);
                $model = new SolicitudModel();
                $resultado1 = $model->enviarSolicitud($solicitud);

            if ($resultado1["status"] == "success") {

                $objeto = new stdClass();
                $objeto->passw = $_POST['new_password'];
                
                $solicitud = new Solicitud("usuario","changePassword",$id, $objeto);
                $model = new SolicitudModel();
                $resultado2 = $model->enviarSolicitud($solicitud);
                
                if ($resultado2["status"] == "success") {
                    $data = ["message" => "Contraseña cambiada correctamente."];
                    $vista->show("login", $data);                    
                }
                
            }else{

                $solicitud = new Solicitud("usuario","get",$id, null);
                $model = new SolicitudModel();
                $data["usuario"] =  (object)  $model->enviarSolicitud($solicitud);

                $data["error"] = "Contraseña incorrecta.";
                $vista->show("change-passw", $data);
            }
        }
    }

    public static function blockUser($user_id){
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
    
        $solicitud = new Solicitud("usuario","blockUser",$user_id,null);
        $model = new SolicitudModel();
        $model->enviarSolicitud($solicitud);
        
        header("Location: /pagina/index.php?controller=MainController&action=index");
    }

    public static function deleteUser($id){

        $solicitud = new Solicitud("usuario","delete",$id, null);
        $model = new SolicitudModel();
        $model->enviarSolicitud($solicitud);
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        session_unset(); 
        session_destroy();
        header("Location: /pagina/index.php?controller=MainController&action=index");
    }

    public static function checkToken($id_usuario):bool{
        $resultado = false;

        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        if (isset($_SESSION['token']) && isset($_SESSION['id_usuario'])) {

            $solicitud = new Solicitud("token","get",$id_usuario, null);
            $model = new SolicitudModel();
            $token = $model->enviarSolicitud($solicitud);
    
            $tokenBD = $token;
            $tokenSession = $_SESSION['token'];
    
            if (hash_equals($tokenBD["token"],$tokenSession["token"])) {
                if (strtotime($tokenBD["fecha_expiracion"]) < time()) {
                    $resultado = true;
                }
            }
        }

        return $resultado;
    }
}

