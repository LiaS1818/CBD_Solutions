<?php
require 'includes/app.php';
use App\Carrito;

session_start();
$idS = session_id();
if (!isset($_POST["id_producto"])) {
    exit("No hay id_producto");
}

 Carrito::quitarProductoDelCarrito($_POST['id_producto'], $idS );
header("Location: ver_carrito.php");
?>