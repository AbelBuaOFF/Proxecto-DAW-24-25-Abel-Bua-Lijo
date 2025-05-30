<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ElTablonDigital</title>
    <link rel="stylesheet" href="./assets/styles/styles.css">
    <link rel="stylesheet" href="./assets/styles/login-registro.css">
    <link rel="stylesheet" href="./assets/fontsawesome/css/all.min.css">
    <script src="./assets/scripts/scritp.js" defer></script>
</head>
<body>
    <?php
    include("header.php");
    ?>
    <main class="main">
        <section class="section-login">
            <form action="./home.html" method="get" class="form-login">
                <h2 class="h2">Iniciar Sesion</h2>
                <ul class="fila-form">
                    <label for="email"> Correo Electronico:</label>
                    <input type="email" placeholder="Correo Electronico..." name="email" id="email" required>
                </ul>
                <ul class="fila-form">
                    <label for="password"> Contraseña:</label>
                    <input type="password" placeholder="Contraseña..." name="password" id="password" required>
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