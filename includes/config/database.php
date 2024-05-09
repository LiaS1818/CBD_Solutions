
<?php

function conectarBD() : mysqli {
    $db = new mysqli('localhost', 'root', '', 'appcdbsolu'); // la forma orientada a objetos

    if (!$db) {
        echo "Error no se pudo conectar";
    }

    return $db;
} 

?>