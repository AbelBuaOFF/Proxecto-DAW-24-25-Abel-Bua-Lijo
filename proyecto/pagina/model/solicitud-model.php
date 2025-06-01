<?php
class Solicitud{

    public string $controller;
    public string $function;
    public ?int $id;
    public ?stdClass $data;

    public function __construct($controller, $function, $id=null, $data=null)
    {
        $this->controller = $controller;
        $this->function = $function;
        $this->id = $id ?? null;
        $this->data = $data ?? null;
    }

    public function toJson(): String {
        return json_encode($this->data, JSON_PRETTY_PRINT);
    }

    /**
     * Get the value of controller
     */ 
    public function getController()
    {
        return $this->controller;
    }

    /**
     * Set the value of controller
     *
     * @return  self
     */ 
    public function setController($controller)
    {
        $this->controller = $controller;

        return $this;
    }

    /**
     * Get the value of function
     */ 
    public function getFunction()
    {
        return $this->function;
    }

    /**
     * Set the value of function
     *
     * @return  self
     */ 
    public function setFunction($function)
    {
        $this->function = $function;

        return $this;
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
     * Get the value of data
     */ 
    public function getData()
    {
        return $this->data;
    }

    /**
     * Set the value of data
     *
     * @return  self
     */ 
    public function setData($data)
    {
        $this->data = $data;

        return $this;
    }
}
class SolicitudModel{
 
    public function enviarSolicitud($solicitud){
        $resultado = null;

        $controller = $solicitud->getController();
        $url = "http://apache:8080/api/route.php/".$controller;

        $send= new stdClass();

        $send->function = $solicitud->getFunction();
        if ($solicitud->getId() != null) {
            $send->id = $solicitud->getId();
        } 

        if ($solicitud->getData() != null) {
            $send->data = $solicitud->getData();
        }
        $data_json = json_encode($send);
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
            error_log("Error al enviar la solicitud: " . $th->getMessage());
        }finally{
            curl_close($curl);
        }
       
        return json_decode($resultado, true);
    }

}