<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TablonPersonal</title>
    <link rel="stylesheet" href="./assets/styles/styles.css">
    <link rel="stylesheet" href="./assets/fontsawesome/css/all.min.css">
    <script>
        <?php
        $host = $_SERVER['HTTP_HOST'];
        $script = $_SERVER['SCRIPT_NAME'];
        ?>
        const baseUrl = "http://<?php echo $host . $script; ?>";
    </script>
    <script src="./assets/scripts/scritp.js" defer></script>
</head>
<body>
<?php
    include("header.php");
    ?>
    <main class="main">
        <section class="section-anuncios">
        </section>
    </main>
    <?php
        include("footer.php");
        ?>
</body>
</html>