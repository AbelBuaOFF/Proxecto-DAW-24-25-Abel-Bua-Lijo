<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ElTablonDigital</title>
    <link rel="stylesheet" href="./src/styles/styles.css">
    <link rel="stylesheet" href="./assets/fontsawesome/css/all.min.css">
</head>
<body>
    <?php
    include("header.php");
    ?>
    <main class="main">
        <section class="section-login">
            <form action="?controller=UserController&action=userLogin" method="post" class="form-login">
                <?php 
                if (isset($data["message"])) {
                    echo ("<p class='error'>".$data["message"]."</p>");
                }
                ?>
                <h2 class="h2">Iniciar Sesion</h2>
                <ul class="fila-form">
                    <label for="nombre_usuario">Nombre de Usuario:</label>
                    <input type="text" placeholder="abel123" name="nombre_usuario" id="nombre_usuario" required>
                </ul>
                <ul class="fila-form">
                    <label for="password"> Contraseña:</label>
                    <input type="password" placeholder="abc123." name="password" id="password" required>
                </ul>
                <ul class="grupo-btn">
                    <a href="?controller=MainController&action=index" class="btn-volver btn">Volver</a>
                    <button type="submit" class="btn">Iniciar Sesion</button>
                </ul>
            </form>
        </section>
    </main>
</body>
<?php

include("footer.php");
?>