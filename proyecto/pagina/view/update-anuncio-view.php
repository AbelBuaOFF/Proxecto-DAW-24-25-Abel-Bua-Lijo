<?php
           
            $host = $_SERVER['HTTP_HOST'];
            $script = $_SERVER['SCRIPT_NAME'];
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Anuncio</title>
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
            <form action="?controller=AnuncioController&action=updateAnuncio" method="post" class="form-login" enctype="multipart/form-data">

                <h2 class="h2">Editar Anuncio</h2>
                    <input type="hidden" name="id_anuncio" value="<?php echo $data["anuncio"]->id ?>">

                    <label for="titulo">Titulo:</label>
                    <input type="text" placeholder="Se vende ..." name="titulo" id="titulo" 
                    value="<?php echo $data["anuncio"]->titulo ?>" required>
                
                    <label for="descripcion">Descripcion:</label>
                    <input type="text" placeholder="en buen estado..." name="descripcion" id="descripcion"
                    value="<?php echo $data["anuncio"]->descripcion ?>" required>
                
                    <label for="contenido">Contacto y Mas informacion:</label>
                    <textarea id="contenido" placeholder="informacion de contacto, y mas informacion.." name="contenido" rows="5" required>
                        <?php echo $data["anuncio"]->descripcion ?>
                    </textarea>
                </ul>
                <ul class="anuncio-links">
                    <label for="id_tipo_anuncio">Tipo de Anuncio:</label>
                    <select id="id_tipo_anuncio" name="id_tipo_anuncio" required>
                        <?php
                        foreach ($data["tipo_anuncio"] as $tipo) {
                            $selected = ($tipo["id"] == $data["anuncio"]->id_tipo_anuncio) ? "selected" : "";
                            echo "<option value='{$tipo["id"]}' $selected>{$tipo["nombre_tipo_anuncio"]}</option>";
                        }
                        ?>
                    </select>
                    <label for="id_categoria">Categoria:</label>
                    <select id="id_categoria" name="id_categoria" required>
                        <?php
                        foreach ($data["categorias"] as $categoria) {
                            $selected = ($categoria["id"] == $data["anuncio"]->id_categoria) ? "selected" : "";
                            echo "<option value='{$categoria["id"]}' $selected>{$categoria["nombre_categoria"]}</option>";
                        }
                        ?>
                    </select>
                    <label for="id_localidad">Localidad:</label>
                    <select id="id_localidad" name="id_localidad" required>
                        <?php
                        foreach ($data["localidades"] as $localidad) {
                            $selected = ($localidad["id"] == $data["anuncio"]->id_localidad) ? "selected" : "";
                            echo "<option value='{$localidad["id"]}' $selected>{$localidad["nombre_localidad"]}</option>";
                        }
                        ?>
                    </select>
                </ul>
                <ul class="fila-form">
                    <label for="imagen">Imagen:</label>
                        <figure>
                        <?php 
                            echo "<img src='{$data["anuncio"]->imagen_url}' alt='Imagen del anuncio' class='imagen-anuncio'>";
                        ?>
                        </figure>
                    <input type="file" id="imagen" name="imagen" accept="image/*">
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