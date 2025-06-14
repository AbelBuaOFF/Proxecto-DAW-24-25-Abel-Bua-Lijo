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
        <article class="anuncio-card">
                    <h3 class="anuncio-titulo"><?php echo $data["anuncio"]->titulo ?></h3>
                    <div class="anuncio-content">
                        <div class="anuncio-texto">
                                <p><span class="bold">Descripcion:</span><?php echo $data["anuncio"]->descripcion ?></p>
                                <p><span class="bold">Contenido: </span><?php echo $data["anuncio"]->contenido ?></p>
                        </div>
                        <figure>
                            <img class="anuncio-img" src="<?php echo $data["anuncio"]->imagen_url ?>" alt="${anuncio.titulo}">
                        </figure>
                    </div>
                    <ul class="anuncio-links">
                        <?php if (isset($data["categoria"])) {
                            echo "<li>Categoria: <span class='bold'>".$data["categoria"]->nombre_categoria."</span></li>";
                        }?>
                        <?php if (isset($data["localidad"])) {
                            echo "<li>Localidad: <span class='bold'> ".$data["localidad"]->nombre_localidad."</span></li>";
                        }?>
                        <li>Publicado por: <a href="?controller=UserController&action=userPage&id=<?php echo $data["anuncio"]->id_usuario?>">
                        <span class="link" ><?php echo $data["usuario"]->nombre_usuario?><span></a></li>
                    </ul>
        </article>
        <?php
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        $id_user = $data["anuncio"]->id_usuario;
        if (isset($_SESSION['id_usuario']) && $_SESSION['id_usuario'] == $id_user) {
            $id = $data["anuncio"]->id;
            echo "<aside class='panelTools'>";
                echo "<p>Opciones</p>";
                echo "<ul>";
                    echo "<li><a href='?controller=AnuncioController&action=updateAnuncioPage&id=$id'><i class='fas fa-edit'></i> Modificar Anuncio</a></li>";
                    echo "<li><a href='?controller=AnuncioController&action=deleteAnuncio&id=$id'><i class='fa fa-trash'></i> Eliminar Anuncio</a></li>";
                echo "</ul>";
            echo "</aside>"; 
        }
        ?>
    </main>
    <?php
        include("footer.php");
        ?>
</body>
</html>