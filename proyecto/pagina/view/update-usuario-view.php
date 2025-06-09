<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ElTablonDigital</title>
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
        <section class="section-login usuario"> 
            <form action="?controller=UserController&action=updateUser" method="post" class="form-login">
            <?php
                if (isset($data['error'])) {
                    foreach ($data['error'] as $error) {
                        echo '<p class="error">'.$error.'</p>';
                    }
                }
                ?>
                <h2 class="h2">Modificar datos del Usuario:</h2>
                <input type="hidden" name="tipo_usuario" value="<?php echo $data["usuario"]->tipo_usuario ?>">
                <ul class="fila-form">
                    <label for="nombre-usuario"> Nombre de Usuario:</label>
                    <input type="text" placeholder="Nombre..." name="nombre_usuario" id="nombre_usuario" 
                    value="<?php echo $data["usuario"]->nombre_usuario ?>" required>
                </ul>
                <ul class="fila-form">
                    <label for="email"> Correo Electronico:</label>
                    <input type="email" placeholder="Correo Electronico..." name="email" id="email"
                     value="<?php echo $data["usuario"]->email?>" required>
                </ul>
                <ul class="section-tipo-form fila-form empresa">
                    <?php if ($data["usuario"]->tipo_usuario == "empresa") { 
                        $nEmpresa = $data["usuario"]->nombre_comercial;
                        $urlWeb = $data["usuario"]->url_web;
                            echo '<fieldset class="empresa">';
                                echo '<p>Datos de la Empresa</p>';
                                
                                echo '<ul class="fila-form">';
                                    echo '<label for="nombre_comercial"> Nombre Comercial:</label>';
                                    echo '<input type="text" placeholder="Nombre..." name="nombre_comercial" id="nombre_comercial"
                                    value='.$nEmpresa.' required>';
                                echo '</ul>';
                                
                                echo '<ul class="fila-form">';
                                    echo '<label for="url_web"> Página Web:</label>';
                                    echo '<input type="text" placeholder="Nombre..." name="url_web" id="url_web"  value='.$urlWeb.'>';
                                echo '</ul>';

                            echo '</fieldset>';
                    }?>                    
                </ul>
                <ul class="grupo-btn">
                    <a href="?controller=UserController&action=userPage&id=<?php echo $data["usuario"]->id ?>" 
                    class="btn-volver btn">Volver</a>
                    <button type="submit" class="btn">Guardar Datos</button>
                </ul>
            </form>
        </section>
    </main>
</body>
<?php 
    include("footer.php"); 
    ?>
