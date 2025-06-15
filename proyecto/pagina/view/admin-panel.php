<script src="../pagina/src/scripts/admin-script.js" defer></script>
    <aside class="AdminTools">
            <button  class="btn btn-admin"><i class="fas fa-gear"></i></button>
            <ul class="opciones off">
                <li><p><span class="bold">Panel de Administrador</p><span></li>
                <?php
                   
                    if (isset($data["anuncio"]) ) {
                        $id_anuncio= $data["anuncio"]->id;
                        echo  "<li><a class='bloquear' href='?controller=AnuncioController&action=blockAnuncio&id=$id_anuncio'>Bloquear Anuncio</a></li>";
                    }else if (isset($data["usuario"]) && $data["usuario"]->id_rol != 1 ) {
                        $id_usuario=$data["usuario"]->id;
                        echo  "<li><a class='bloquear' href='?controller=UserController&action=blockUser&id=$id_usuario'>Bloquear Usuario</a></li>";
                    }
                ?>
            </ul>
    </aside>