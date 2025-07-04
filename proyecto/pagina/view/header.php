<link rel="icon" href="assets/img/logo.png" type="image/x-icon">
<script src="../pagina/src/scripts/header-script.js" defer></script>
    <header class="header">
        <ul class="logo-menu">
            <a class="logo" href="?controller=MainController&action=index">
                <img src="./assets/img/logo.png" alt="" class="logo">
            </a>
            <h1 class="textoLogo">ElTablonDigital</h1>
        </ul>
        <nav class="navegador">
            <ul class="nav-menu">
                <?php
                if (session_status() === PHP_SESSION_NONE) {
                     session_start();
                }
                if (isset($_SESSION['id_usuario']) &&  isset($_SESSION['token'])) {
                    echo '<li><a href="?controller=AnuncioController&action=publicarAnuncio" class="publicar-anuncio"><i class="fa fa-plus" aria-hidden="true"></i> Publicar Anuncio </a></li>';
                    echo '<li><a href="?controller=UserController&action=home"><i class="fa-solid fa-house"></i> Tus Anuncios</a></li>';
                    echo '<li><a href="?controller=UserController&action=userPage&id='.$_SESSION['id_usuario'].'"><i class="fa-solid fa-user"></i> Tu Perfil</a></li>';
                    echo '<li><a title="Cerrar Sesión" class="btn-cerrar-sesion btn" href="?controller=UserController&action=Logout"><i class="fa-solid fa-power-off"></i></a></li>';
                } else {
                    echo '<li><a class="btn-sesion btn-login btn" href="?controller=MainController&action=login">Iniciar Sesion</a></li>';
                    echo '<li><a class="btn-sesion btn-registro btn" href="?controller=MainController&action=registro">Registrarse</a></li>';
                }
                ?>
            </ul>
            <ul class="menu-hamburguesa off">
                <?php
                if (isset($_SESSION['id_usuario']) &&  isset($_SESSION['token'])) {
                    echo '<li><a href="?controller=AnuncioController&action=publicarAnuncio" class="publicar-anuncio"><i class="fa fa-plus" aria-hidden="true"></i> Publicar Anuncio </a></li>';
                    echo '<li><a href="?controller=UserController&action=home"><i class="fa-solid fa-house"></i> Tus Anuncios</a></li>';
                    echo '<li><a href="?controller=UserController&action=userPage&id='.$_SESSION['id_usuario'].'"><i class="fa-solid fa-user"></i> Tu Perfil</a></li>';
                    echo '<li><a title="Cerrar Sesión" class="btn-cerrar-sesion btn" href="?controller=UserController&action=Logout"><i class="fa-solid fa-power-off"></i></a></li>';
                } else {
                    echo '<li><a class="btn-sesion btn-login btn" href="?controller=MainController&action=login">Iniciar Sesion</a></li>';
                    echo '<li class="cerrar-sesion"><a class="btn-sesion btn-registro btn" href="?controller=MainController&action=registro">Registrarse</a></li>';
                }
                ?>
                <li><a href="?controller=MainController&action=normativa">Aviso Legal</a></li>
                <li><a href="?controller=MainController&action=normativa#privacidade">Politica de Privacidad</a></li>
                <li><a href="?controller=MainController&action=normativa#cookies">Politica de Cookies</a></li>
            </ul>
        </nav>
        <a href="#" class="menu-hamburguesa-btn"><i class="fas fa-bars"></i></a>
    </header>