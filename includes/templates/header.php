<?php

    if (!isset($_SESSION)) {
        session_start();
    }

    $auth = $_SESSION['login'] ?? null;
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Green Vitality CBD Solutions </title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;700;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="/CBD_Solutions/build/css/app.css">
</head>
<body>

    <header class="header">
        <div class="contenedor contenido-header">
            <h1>Green Vitality CBD Solutions </h1>

            <nav class="navegacion-principal">
                <?php if($auth): ?>
                 <a href="/CBD_Solutions/index.php">Inicio</a>
                <a href="/CBD_Solutions/productos.php">Productos</a>
                <a href="#">Contacto</a>
                <a href="/CBD_Solutions/cerrar-sesion.php">Cerrar Sesión</a>
             <?php else : ?>
                <a href="/CBD_Solutions/index.php">Inicio</a>
                <a href="/CBD_Solutions/productos.php">Productos</a>
                <a href="#">Contacto</a>
                <a href="/CBD_Solutions/login.php">Login</a>
                <a href="/CBD_Solutions/registro.php">Registro</a>
                <?php endif; ?>
            </nav>
        </div>
    </header>

</html>