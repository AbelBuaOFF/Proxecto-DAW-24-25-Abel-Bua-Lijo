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
        const categorias = <?php echo json_encode($data["categorias"]) ;?>;
        const localidades = <?php  echo json_encode($data["localidades"]);?>;
    </script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js" defer></script>
    <script src="../pagina/src/scripts/main-script.js" defer></script>
</head>

<body>
    <?php
    include("header.php");

    ?>
    <main class="main">
        
        <section class="buscador">
            <div>
            <h2 class="h2">Buscador de anuncios.</h2>
            <form action="" method="get" class="formBusqueda">
                <input type="text" name="buscador" id="buscador" placeholder="Buscar Auncio...">
                <select name="categoria" id="categoria" class="categorias">
                    <option value='0'>Seleccionar Categoria</option>
                    <?php
                    foreach ($data["categorias"] as $categoria) {
                        echo "<option value='{$categoria["id"]}'>{$categoria["nombre_categoria"]}</option>";
                    }
                    ?>
                </select>
                <select name="localidad" id="localidad" class="localizacion">
                    <option value='0'>Seleccionar Localizacion</option>
                    <?php
                    foreach ($data["localidades"] as $localidad) {
                        echo "<option value='{$localidad["id"]}'>{$localidad["nombre_localidad"]}</option>";
                    }
                    ?>
                </select>
                <button type="submit"><i class="fa-solid fa-magnifying-glass"></i>
                </button>
            </form>
            </div>
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