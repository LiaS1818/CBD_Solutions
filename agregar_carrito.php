<?php
    require 'includes/app.php';
use App\Carrito;
$carrito = new Carrito();


if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $carrito = new Carrito($_POST['carrito_usuarios']);
    $carrito->crear();
}

header("Location: productos.php");