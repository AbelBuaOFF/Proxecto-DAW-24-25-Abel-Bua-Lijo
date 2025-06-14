<script src="../pagina/src/scripts/admin-script.js" defer></script>
    <aside class="AdminTools">
            <button  class="btn btn-admin"><i class="fas fa-gear"></i></button>
            <ul class="opciones off">
                <li><p><span class="bold">Panel de Administrador</p><span></li>
                <?php
                    if (isset($data["categorias"]) && isset($data["categorias"]) ) {
                        echo  "<li><a class='bloquear' href= ''>Bloquear Anuncios</a></li>";
                    }
                ?>
                <?php 
                    if (isset($data["usuario"]) && $data["usuario"]->id_rol != 1 ) {
                        echo  "<li><a class='bloquear' href= >Bloquear Usuario</a></li>";
                    }
                ?>
            </ul>
    </aside>