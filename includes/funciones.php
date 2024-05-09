<?php


define('TEMPLATES_URL', __DIR__ . '/templates'); //__dir__ Toma la ubicacion del archivo actual
define('FUNCIONES_URL',__DIR__ .'funciones.php');// esto hace codigo portable
define('CARPETA_IMAGENES', __DIR__. '/../imagenes/');


function incluirTemplate($nombre) {
    include  TEMPLATES_URL . "/${nombre}.php";
}

function estaAutenticado() : bool {
    session_start();
    if (!$_SESSION['login']) {
        header('Location: /CBD_Solutions');
    }

    return true;
}

function debuguear($variable){
    echo "<pre>";
    var_dump($variable);
    echo "</pre>";
    exit;
}

// function obtenerCantidadProductos() {
//     $bd = conectarBD();
//     $sentencia = $bd->prepare("SELECT productos.id, productos.nombre, productos.descripcion, productos.precio, carrito_usuarios.cantidad
//     FROM productos
//     LEFT JOIN carrito_usuarios ON productos.id = carrito_usuarios.id_producto
//     WHERE carrito_usuarios.id_sesion = ?;
//     ");
//     $idSesion = session_id();

//     debuguear($sentencia);
//     return $sentencia;
// }

// Escape / Sanitizar HTML
function s($html) : string{
    
    $s = htmlspecialchars($html);

    return $s;
}

/** Funciones Carrito  **/
////////////////////////////////////////////////////////////////////

