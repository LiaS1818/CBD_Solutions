<?php

require 'funciones.php';
require 'config/database.php';
require __DIR__ . '/../vendor/autoload.php';

//Conectarnos a la base de datos

$db = conectarBD();

use App\ActiveRecord;

ActiveRecord::setDB($db); //todos los objetos tendran referencia a la base de datos
