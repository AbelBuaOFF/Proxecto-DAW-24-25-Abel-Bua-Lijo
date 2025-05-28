<?php
include_once(PATH_VIEW."view.php");


abstract class PageController{
    protected View $vista;

    public function __construct()
    {
        $this->vista = new View();
    }

    public function enviarSolicitud($solicitud){
        $resultado = null;

        $controller = $solicitud->getController();
        $url = "http://apache:8080/api/route.php/".$controller;

        $data_json = json_encode($solicitud);

        try {

            $curl = curl_init($url);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($curl, CURLOPT_POST, true);
            curl_setopt($curl, CURLOPT_POSTFIELDS, $data_json);
            curl_setopt($curl, CURLOPT_HTTPHEADER, [
                'Content-Type: application/json',
                'Content-Length: ' . strlen($data_json)
            ]);
            $response = curl_exec($curl);

            if ($response === false) {
                echo "cURL Error: " . curl_error($curl);
            } else {
                $resultado = $response;
            }
        } catch (\Throwable $th) {
            //throw $th;
        }finally{
            curl_close($curl);
        }
        return $resultado;
    }

}