<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pagina de Usuario</title>
    <link rel="stylesheet" href="./src/styles/styles.css">
    <link rel="stylesheet" href="./assets/fontsawesome/css/all.min.css">
</head>
<body>
<?php
    include("header.php");
    ?>
    <main class="main">
        <section class="section-usuario">
            <article class="usuario">
            <h2>Pagina de Usuario</h2>
            <p><?php echo $data["usuario"]->nombre_usuario ?></p>
            <p>Email: <?php echo $data["usuario"]->email ?></p>
            <?php if ($data["usuario"]->tipo_usuario == "empresa") { 
                echo '<p>Nombre Comercial: $data["usuario"]->nombre_comercial ?></p>';
                echo '<p>URL Web: <a href="$data["usuario"]->url_web">  $data["usuario"]->url_web ?></a></p>';
            } ?>
            </article>
        </section>
    </main>
    <?php
        include("footer.php");
        ?>
</body>
</html>