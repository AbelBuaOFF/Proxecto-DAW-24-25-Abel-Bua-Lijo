<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cambiar Contraseña</title>
    <link rel="stylesheet" href="./src/styles/styles.css">
    <link rel="stylesheet" href="./assets/fontsawesome/css/all.min.css">
</head>
<body>
    <?php
    include("header.php");
    ?>
    <main class="main">
        <section class="section-login">
            <form action="?controller=UserController&action=changePass" method="post" class="form-login">
                <?php 
                if (isset($data["error"])) {
                    echo ("<p class='error'>".$data["error"]."</p>");
                    if (isset($_GET['error']) && $_GET['error'] == 1) {
                        echo ("<p class='error'>Las Contraseñas no coinciden.</p>");
                    }
                }
                ?>
                <h2 class="h2">Iniciar Sesion</h2>
                <input type="hidden" id="nombre_usuario" name="nombre_usuario" value="<?php echo $data["usuario"]->nombre_usuario ?>">
                <ul class="fila-form">
                    <label for="ant_password"> Anterior Contraseña:</label>
                    <input type="password" placeholder="abc123." name="ant_password" id="ant_password" required>
                </ul>
                <ul class="fila-form">
                    <label for="new_password"> Nueva Contraseña:</label>
                    <input type="password" placeholder="abc123." name="new_password" id="new_password" required>
                </ul>
                <ul class="fila-form">
                    <label for="repeat_password"> Repite Contraseña:</label>
                    <input type="password" placeholder="abc123." name="repeat_password" id="repeat_password" required>
                </ul>
                <ul class="grupo-btn">
                    <a href="?controller=UserController&action=userPage&id=<?php echo $_SESSION['id_usuario'] ?>" class="btn-volver btn">Volver</a>
                    <button type="submit" class="btn">Cambiar Contraseña</button>
                </ul>
            </form>
        </section>
    </main>
</body>
<?php

include("footer.php");
?>