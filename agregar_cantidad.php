<?php
require 'includes/app.php';
use App\Producto;

session_start();
$idS = session_id();
if (!isset($_POST["id_producto"])) {
    exit("No hay id_producto");
}

 Producto::sumarProductos($_POST['id_producto'], $idS );
header("Location: ver_carrito.php");
?>