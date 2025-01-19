<?php 
  if(!isset($_SESSION)) {
    session_start();
  }

  $auth = $_SESSION['login'] ?? false;

  if(!isset($inicio)) {
    $inicio = false;
  }

?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../build/css/app.css">
    <title>Bienes Raices</title>
</head>

<body>

    <header class="header <?php echo $inicio ? 'inicio' : ''; ?>">
        <div class="contenedor contenido-header">
            <div class="barra">
                <a href="/">
                    <img src="../build/img/logo.svg" alt="Logotipo de Bienes Raices" />
                </a>

                <div class="mobile-menu">
                    <img src="../build/img/barras.svg" alt="icono menu">
                </div>

                <nav class="navegacion">
                    <a href="/nosotros">Nosotros</a>
                    <a href="/anuncios">Anuncios</a>
                    <a href="/blog">Blog</a>
                    <a href="/contacto">Contacto</a>
                    <?php if ($auth) { ?>
                        <a href="/logout">Cerrar Sesión</a>
                    <?php } ?>
                </nav>

                <img class="btn-dark" src="../build/img/dark-mode.svg" alt="darkMode">

            </div><!--.barra-->

            <?php if ($inicio) {
                echo "<h1>Venta de Casas y Departamentos Exclusivos de Lujo</h1>";
            } ?>

        </div>
    </header>


    <?php echo $contenido; ?>


    <footer class="footer seccion">
        <div class="contenedor contenedor-footer">
            <nav class="navegacion">
                <a href="/nosotros">Nosotros</a>
                <a href="/anuncios">Anuncios</a>
                <a href="/blog">Blog</a>
                <a href="/contacto">Contacto</a>
            </nav>
        </div>

        <p class="copyright">Todos los derechos Reservados <?php echo date('Y'); ?> &copy;</p>
    </footer>

    <script src="../build/js/bundle.min.js"></script>
</body>

</html>