<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $data["anuncio"]->titulo ?></title>
    <link rel="stylesheet" href="./src/styles/styles.css">
    <link rel="stylesheet" href="./src/fontsawesome/css/all.min.css">
</head>
<body>
<?php
    include("header.php");
    ?>
    <main class="main">
        <h2>ANUNCIO</h2>
        <section class="section-anuncios">
        <article class="anuncio">
                <h3 class="anuncio-titulo"><?php echo $data["anuncio"]->titulo ?></h3>
                <h4><?php echo $data["anuncio"]->descripcion ?></h4>
                <figure>
                    <img class="anuncio-img" src="<?php echo $data["anuncio"]->imagen_url ?>" alt="${anuncio.titulo}">
                </figure>
                <p class="anuncio-texto"><?php echo $data["anuncio"]->contenido ?></p>
                <ul class="anuncio-data">
                    <?php if (isset($data["categoria"])) {
                        echo "<li>Categoria: ".$data["categoria"]->nombre_categoria."</li>";
                    }?>
                    <?php if (isset($data["localidad"])) {
                        echo "<li> Localidad:".$data["localidad"]->nombre_localidad."</li>";
                    }?>
                    <li>Publicado por: <a href="?controller=UserController&action=pageUser&id=<?php echo $data["anuncio"]->id_usuario?>">
                        <span class="nombre_usuario" ><?php echo $data["usuario"]->nombre_usuario?><span>
                        </a></li>
                    
                </ul>
            </article>
        </section>
    </main>
    <?php
        include("footer.php");
        ?>
</body>
</html>