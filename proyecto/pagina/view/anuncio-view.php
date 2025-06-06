<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $data["anuncio"]->titulo ?></title>
    <link rel="stylesheet" href="./src/styles/styles.css">
    <link rel="stylesheet" href="./assets/fontsawesome/css/all.min.css">
</head>
<body>
<?php
    include("header.php");
    ?>
    <main class="main">
        <h2>ANUNCIO</h2>
        <article class="anuncio-card">
            
                    <h3 class="anuncio-titulo"><?php echo $data["anuncio"]->titulo ?></h3>
                    <figure>
                        <img class="anuncio-img" src="<?php echo $data["anuncio"]->imagen_url ?>" alt="${anuncio.titulo}">
                    </figure>

                    <p><?php echo $data["anuncio"]->descripcion ?></p>
                    <p class="anuncio-texto"><?php echo $data["anuncio"]->contenido ?></p>
                    <ul class="anuncio-links">
                        <?php if (isset($data["categoria"])) {
                            echo "<li>Categoria: ".$data["categoria"]->nombre_categoria."</li>";
                        }?>
                        <?php if (isset($data["localidad"])) {
                            echo "<li> Localidad:".$data["localidad"]->nombre_localidad."</li>";
                        }?>
                        <li>Publicado por: <a href="?controller=UserController&action=userPage&id=<?php echo $data["anuncio"]->id_usuario?>">
                        <span class="link" ><?php echo $data["usuario"]->nombre_usuario?><span></a></li>
                    </ul>
        </article>
    </main>
    <?php
        include("footer.php");
        ?>
</body>
</html>