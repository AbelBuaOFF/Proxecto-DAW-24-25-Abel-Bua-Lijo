<?php
           
            $host = $_SERVER['HTTP_HOST'];
            $script = $_SERVER['SCRIPT_NAME'];
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Publicar Anuncio</title>
    <link rel="stylesheet" href="./src/styles/styles.css">
    <link rel="stylesheet" href="./assets/fontsawesome/css/all.min.css">
</head>
<body>
<?php
    include("header.php");
    if (!isset($_SESSION['id_usuario']) ||  !isset($_SESSION['token'])){
        header("Location: ?controller=MainController&action=index");
     }
    ?>
    <main class="main">
    <section class="section-login">
        <?php
        if (isset($respuesta["error"])) {
            echo "<p>class='error'>{$respuesta["error"]}</p>";
        }
        ?>
            <form action="?controller=AnuncioController&action=sendAnuncio" method="post" class="form-login" enctype="multipart/form-data">
                <h2 class="h2">Publicar un Nuevo Anuncio.</h2>
            
                    <label for="titulo">Titulo:</label>
                    <input type="text" placeholder="Se vende ..." name="titulo" id="titulo" required>
                
                    <label for="descripcion">Descripcion:</label>
                    <input type="text" placeholder="en buen estado..." name="descripcion" id="descripcion" required>
                
                    <label for="contenido">Contacto y Mas informacion:</label>
                    <textarea id="contenido" placeholder="informacion de contacto, y mas informacion.." name="contenido" rows="5" required></textarea>
                </ul>
                <ul class="fila-form">
                    <label for="id_tipo_anuncio">Tipo de Anuncio:</label>
                    <select id="id_tipo_anuncio" name="id_tipo_anuncio" required>
                        <?php
                        foreach ($data["tipos_anuncio"] as $tipo) {
                           echo "<option value='{$tipo["id"]}'>{$tipo["nombre_tipo_anuncio"]}</option>";
                        }
                        ?>
                    </select>
                </ul>
                <ul class="fila-form">
                    <label for="id_categoria">Categoria:</label>
                    <select id="id_categoria" name="id_categoria" required>
                        <?php
                        foreach ($data["categorias"] as $categoria) {
                            echo "<option value='{$categoria["id"]}'>{$categoria["nombre_categoria"]}</option>";
                        }
                        ?>
                    </select>
                </ul>
                <ul class="fila-form">
                    <label for="id_localidad">Localidad:</label>
                    <select id="id_localidad" name="id_localidad" required>
                        <?php
                        foreach ($data["localidades"] as $localidad) {
                            echo "<option value='{$localidad["id"]}'>{$localidad["nombre_localidad"]}</option>";
                        }
                        ?>
                    </select>
                </ul>
                <ul class="fila-form">
                    <li>
                        <label for="imagen">Imagen:</label>
                    </li>
                    <li>
                        <input type="file" id="imagen" name="imagen" accept="image/*">
                    </li>
                </ul>
                <ul class="grupo-btn">
                    <a href="?controller=MainController&action=index" class="btn-volver btn">Volver</a>
                    <button type="submit" class="btn">Guardar</button>
                </ul>
            </form>
        </section>
    </main>
    <?php
        include("footer.php");
        ?>
</body>
</html>