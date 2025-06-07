<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pagina de Usuario</title>
    <link rel="stylesheet" href="./src/styles/styles.css">
    <link rel="stylesheet" href="./assets/fontsawesome/css/all.min.css">
</head>
    <?php
    include("header.php");
    ?>
    <main class="main">
    <h2>Pagina de Usuario:</h2>
        <section class="section-usuario">
            
            <article class="usuario-card">
                <figure>
                    <img src="../pagina/uploads/usuarios/perfil_default.jpg" alt="">
                </figure>
                <ul class="usuario-data"> 
                    <li><p><?php echo $data["usuario"]->nombre_usuario ?></p></li>
                    <li><p>Email: <?php echo $data["usuario"]->email ?></p></li>    
                </ul>
            
            <?php if ($data["usuario"]->tipo_usuario == "empresa") { 
                $nEmpresa = $data["usuario"]->nombre_comercial;
                $urlWeb = $data["usuario"]->url_web;
                echo "<ul class='usuario-data'> 
                        <li><p>Cuenta de Empresa</p></li>
                        <li><p>Nombre Comercial: $nEmpresa </p></li>
                        <li><p>URL Web: <span class='link'> $urlWeb </span></p></li>
                    </ul>";
            } ?>
            </article>
        </section>
        <?php
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        $id_user = $data["usuario"]->id;
        if (isset($_SESSION['id_usuario']) && $_SESSION['id_usuario'] == $id_user) {
            $id = $data["usuario"]->id;
            echo "<aside class='panelTools'>";
                echo "<p>Opciones</p>";
                echo "<ul>";
                    echo "<li><a href='?controller=UserController&action=updateUserPage&id=$id'><i class='fas fa-user-edit'></i> Modificar Usuario</a></li>";
                    echo "<li><a href='?controller=UserController&action=deleteUser&id=$id'><i class='fa fa-user-times'></i> Eliminar Usuario</a></li>";
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