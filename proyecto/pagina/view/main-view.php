<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ElTablonDigital</title>
    <link rel="stylesheet" href="./src/styles/styles.css">
    <link rel="stylesheet" href="./assets/fontsawesome/css/all.min.css">
    <script>
        <?php
        $host = $_SERVER['HTTP_HOST'];
        $script = $_SERVER['SCRIPT_NAME'];
        ?>
        const baseUrl = "http://<?php echo $host . $script; ?>";
    </script>
    <script src="../pagina/src/scripts/main-script.js" defer></script>
</head>

<body>
    <?php
    include("header.php");
    ?>
    <main class="main">
        <section class="buscador">
            <h2 class="h2">Buscador de anuncios.</h2>
            <form action="" method="get">
                <input type="text" name="buscador" id="buscador" placeholder="Buscar Auncio...">
                <select name="buscador-categorias" id="buscador-categorias" class="categorias">
                    <option value="">Seleccionar Categoria</option>
                    <?php
                    foreach ($data["categorias"] as $categoria) {
                        echo "<option value='{$categoria["id"]}'>{$categoria["nombre_categoria"]}</option>";
                    }
                    ?>
                </select>
                <select name="buscador-localizacion" id="buscador-localizacion" class="localizacion">
                    <option value="">Seleccionar Localizacion</option>
                    <?php
                    foreach ($data["localidades"] as $localidad) {
                        echo "<option value='{$localidad["id"]}'>{$localidad["nombre_localidad"]}</option>";
                    }
                    ?>
                </select>
                <button type="submit"><i class="fa-solid fa-magnifying-glass"></i>
                </button>
            </form>
        </section>
        <section class="section-anuncios">
        </section>
            <dialog id="modal">
                <article class="elemento-modal">
                <h3 class="anuncio-titulo">Titulo</h3>
                <p class="descripcion"></p>
                <p class="contenido"></p>
                <figure>
                    <img class="anuncio-img" src="" alt="">
                </figure>

                <button onclick="window.modal.close();">Cerrar</button>
                </article>
            </dialog>
    </main>
        <?php
        include("footer.php");
        ?>
        </body>

</html>