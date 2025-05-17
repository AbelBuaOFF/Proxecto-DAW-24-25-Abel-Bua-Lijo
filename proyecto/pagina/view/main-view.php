<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ElTablonDigital</title>
    <link rel="stylesheet" href="./assets/styles/styles.css">
    <link rel="stylesheet" href="./assets/fontsawesome/css/all.min.css">
    <script src="./assets/scripts/scritp.js" defer></script>

</head>
<body>
    <?php 
    include("header.php"); 
    ?>
    <main class="main">
        <section  class="buscador">
            <h2 class="h2">Buscador de anuncios.</h2>
            <form action="" method="get">
                <input type="text" name="buscador" id="buscador" placeholder="Buscar Auncio...">
                <select name="buscador-categorias" id="buscador-categorias" class="categorias">
                    <option value="">Seleccionar Categoria</option>
                </select>
                <select name="buscador-localizacion" id="buscador-localizacion" class="localizacion">
                    <option value="">Seleccionar Localizacion</option>
                </select>
                <button type="submit"><i class="fa-solid fa-magnifying-glass"></i>
                </button>
            </form>
        </section >
        <section class="section-anuncios">
            <article class="anuncio">
                <h3 class="anuncio-titulo">Titulo</h3>
                <img class="anuncio-img" src="" alt="Imagen del anuncio">
                <p class="anuncio-texto">Descripcion: Texto del anuncio.</p>
                <a class="anuncio-bnt">Ver mas...</a>
            </article>
            <article class="anuncio">
                <h3 class="anuncio-titulo">Titulo</h3>
                <img class="anuncio-img" src="" alt="Imagen del anuncio">
                <p class="anuncio-texto">Descripcion: Texto del anuncio.</p>
                <a class="anuncio-bnt">Ver mas...</a>
            </article>
            <article class="anuncio">
                <h3 class="anuncio-titulo">Titulo</h3>
                <img class="anuncio-img" src="" alt="Imagen del anuncio">
                <p class="anuncio-texto">Descripcion: Texto del anuncio.</p>
                <a class="anuncio-bnt">Ver mas...</a>
            </article>

            <article class="anuncio">
                <h3 class="anuncio-titulo">Titulo</h3>
                <img class="anuncio-img" src="" alt="Imagen del anuncio">
                <p class="anuncio-texto">Descripcion: Texto del anuncio.</p>
                <a class="anuncio-bnt">Ver mas...</a>
            </article>
            <article class="anuncio">
                <h3 class="anuncio-titulo">Titulo</h3>
                <img class="anuncio-img" src="" alt="Imagen del anuncio">
                <p class="anuncio-texto">Descripcion: Texto del anuncio.</p>
                <a class="anuncio-bnt">Ver mas...</a>
            </article>
            <article class="anuncio">
                <h3 class="anuncio-titulo">Titulo</h3>
                <img class="anuncio-img" src="" alt="Imagen del anuncio">
                <p class="anuncio-texto">Descripcion: Texto del anuncio.</p>
                <a class="anuncio-bnt">Ver mas...</a>
            </article>
            <article class="anuncio">
                <h3 class="anuncio-titulo">Titulo</h3>
                <img class="anuncio-img" src="" alt="Imagen del anuncio">
                <p class="anuncio-texto">Descripcion: Texto del anuncio.</p>
                <a class="anuncio-bnt">Ver mas...</a>
            </article>
        </section>
    </main>
    <?php 
    include("footer.php"); 
    ?>
</body>
</html>