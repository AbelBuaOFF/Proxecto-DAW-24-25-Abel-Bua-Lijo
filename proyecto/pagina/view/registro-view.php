<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ElTablonDigital</title>
    <link rel="stylesheet" href="./assets/styles/styles.css">
    <link rel="stylesheet" href="./assets/styles/login-registro.css">
    <link rel="stylesheet" href="./assets/fontsawesome/css/all.min.css">
    <script src="./assets/scripts/registro-script.js" defer></script>
</head>
<body>
<?php 
    include("header.php"); 
    ?>
    <main class="main">
    <?php
    if (isset($data['error'])) {
        echo '<p>'.$data['error'].'</p>';
    }
    ?>
        <section class="section-login usuario"> 
            <form action="?controller=UserController&action=addUser" method="post" class="form-login">
            
                <h2 class="h2">Registrarse</h2>
                <ul class="section-tipo-form fila-form">
                    <p>Tipo de Usuario:</p>
                    <label for="radio"> Usuario</label>
                    <input type="radio" name="tipo_usuario" id="tipo_usuario" value="usuario" required checked>
                    <label for="radio"> Empresa</label>
                    <input type="radio" name="tipo_usuario" id="tipo_usuario" value="empresa" required>
                </ul>
                <ul class="fila-form">
                    <label for="nombre-usuario"> Nombre de Usuario:</label>
                    <input type="text" placeholder="Nombre..." name="nombre_usuario" id="nombre_usuario" required>
                </ul>
                <ul class="fila-form">
                    <label for="email"> Correo Electronico:</label>
                    <input type="email" placeholder="Correo Electronico..." name="email" id="email" required>
                </ul>
                <ul class="fila-form">
                    <label for="password"> Contraseña:</label>
                    <input type="password" placeholder="Contraseña..." name="password" id="password" required>
                </ul>
                <ul class="section-tipo-form fila-form empresa">
                </ul>   
                <ul class="grupo-btn">
                    <a href="?controller=MainController&action=index" class="btn-volver btn">Volver</a>
                    <button type="submit" class="btn">Registrarse</button>
                </ul>
            </form>
        </section>
    </main>
</body>
<?php 
    include("footer.php"); 
    ?>
