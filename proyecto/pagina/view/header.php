    <header class="header">
        <ul class="logo-menu">
            <img src="./assets/img/logo.png" alt="" class="logo">
            <h1 class="textoLogo">ElTablonDigital</h1>
        </ul>
        <nav class="navegador">
            <ul class="nav-menu">
                <?php
                if (isset($_SESSION['usuario'])) {
                    echo '<li><a href="" class="publicar-anuncio">Publicar Anuncio</a></li>';
                    echo '<li><a href="">Panel de Usuario</a></li>';
                    echo '<li><button class="btn-cerrar-sesion btn" href="./index.html">Cerrar Sesion</button></li>';
                } else {
                    echo '<li><a class="btn-sesion btn-login btn" href="?controller=MainController&action=login">Iniciar Sesion</a></li>';
                    echo '<li><a class="btn-sesion btn-registro btn" href="?controller=MainController&action=registro">Registrarse</a></li>';
                }
                ?>
            </ul>
        </nav>
        <p class="hamburguesa-menu"><i class="fas fa-bars"></i></p>
    </header>