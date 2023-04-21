<?php 
if(!isset($_SESSION)) {
    session_start();
}

$auth = $_SESSION['login'] ?? false;


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?php echo $nombrePagina ?? 'Bienes Raices'; ?></title>
    <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700,900" rel="stylesheet">
    <link rel="stylesheet" href="/build/css/app.css">
</head>

<body>

    <header class="header <?php echo $inicio ? 'inicio' : '' ?>">
        <div class="contenedor contenido-header">
            <div class="barra">
                <a href="/" class="logo">
                    <img src="/build/img/logo.svg" alt="Logotipo de Bienes Raices">
                </a>
                <div class="mobile-menu">
                    <a href="#navegacion">
                        <img src="/build/img/barras.svg" alt="Icono Menu">
                    </a>
                </div>
                <img class="dark-mode-boton" src="/build/img/dark-mode.svg">
                <nav id="navegacion" class="navegacion">
                    <a href="nosotros.php">Nosotros</a>
                    <a href="anuncios.php">Anuncios</a>
                    <a href="blog.php">Blog</a>
                    <a href="contacto.php">Contacto</a>
                    <a href="admin/index.php">Admin</a>
                    <?php if($auth): ?>
                            <a href="cerrar-sesion.php">Cerrar Sesión</a>
                            <?php else: ?>
                                <a href="login.php">Iniciar Sesión</a>
                            <?php endif; ?>
                </nav>
            </div>
        </div> <!-- contenedor -->
    </header>