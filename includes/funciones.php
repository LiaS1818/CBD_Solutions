<?php


define('TEMPLATES_URL', __DIR__ . '/templates'); //__dir__ Toma la ubicacion del archivo actual
define('FUNCIONES_URL',__DIR__ .'funciones.php');// esto hace codigo portable

function incluirTemplate($nombre) {
    include  TEMPLATES_URL . "/${nombre}.php";
}

function estaAutenticado() : bool {
    session_start();
    if (!$_SESSION['login']) {
        header('Location: /');
    }

    return true;
}

function debuguear($variable){
    echo "<pre>";
    var_dump($variable);
    echo "</pre>";
    exit;
}
