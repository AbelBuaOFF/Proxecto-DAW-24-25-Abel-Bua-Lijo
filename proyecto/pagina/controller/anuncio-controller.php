<?php 
    include_once(PATH_MODEL.'anuncio-model.php');
    class AnuncioController {
        function listAll(){
            $vista= new View;
            $data=null;
            $data['anuncios']=AnuncioModel::getAnuncios();
            $vista->show("main",$data);
        }

    }
