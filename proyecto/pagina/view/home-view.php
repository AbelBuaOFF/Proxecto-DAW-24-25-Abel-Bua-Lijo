<?php
            $host = $_SERVER['HTTP_HOST'];
            $script = $_SERVER['SCRIPT_NAME'];
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TablonPersonal</title>
    <link rel="stylesheet" href="./src/styles/styles.css">
    <link rel="stylesheet" href="./assets/fontsawesome/css/all.min.css">
    <script>
        const baseUrl = "http://<?php echo $host . $script; ?>";
        const categorias = <?php echo json_encode($data["categorias"]) ;?>;
        const localidades = <?php  echo json_encode($data["localidades"]);?>;
    </script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js" defer></script>
    <script src="../pagina/src/scripts/home-script.js" defer></script>
</head>
<body>
<?php
    include("header.php");
    if (!isset($_SESSION['id_usuario']) ||  !isset($_SESSION['token'])){
        header("Location: ?controller=MainController&action=index");
        
    }
    ?>
    <main class="main">
        <h2>HOME</h2>
        <h3>Todos tus anuncios estan aqui</h3>
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