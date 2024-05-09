<?php
    use App\Carrito;
    if (!isset($_SESSION)) {
        session_start();
    }

    $auth = $_SESSION['login'] ?? null;

    $id_sesion = session_id();
    
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
    <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBjuuzqJN0dfiwxfJBBY2Ioe5YhNeV6tXM&callback=inicializarMapa"></script>

</head>
<body>

    <header class="header">
        <div class="contenedor contenido-header">
       
            <h1>Green Vitality CBD Solutions </h1>
            <nav class="navegacion-principal">
            <!-- <div class="hambur"> -->
            
            <label for="menu" class="ventanita">
            
                <img src="iconos/barra-de-menus" alt="" class="logo">
            </label>
            <input id="menu" type="checkbox" class="nav_input">
            
            <?php if($auth): ?>
                <?php echo $id_sesion ?>
                
                <a href="/CBD_Solutions/ver_carrito.php"> Carrito (<?php echo $conteo = count(Carrito::obtenerIDProductosCarrito($id_sesion))?>)</a>
                <a href="/CBD_Solutions/index.php">Inicio</a>
                <a href="/CBD_Solutions/productos.php">Productos</a>
                <a href="/CBD_Solutions/email.php">Contacto</a>
                <a href="/CBD_Solutions/cerrar-sesion.php">Cerrar Sesión</a>
                <?php else : ?>
                    <?php echo $id_sesion ?>
                <a href="/CBD_Solutions/index.php">Inicio</a>
                <a href="/CBD_Solutions/productos.php">Productos</a>
                <a href="/CBD_Solutions/email.php">Contacto</a>
                <a href="/CBD_Solutions/login.php">Login</a>
                <a href="/CBD_Solutions/registro.php">Registro</a>
                <?php endif; ?>
            
            
                
            </nav>
        </div>
    </header>
    
   
</html>