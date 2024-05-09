
<?php

function conectarBD() : mysqli {
    $db = new mysqli('10.0.0.5', 'liaSan', '1234', 'appcbdsolutions'); // la forma orientada a objetos

    if (!$db) {
        echo "Error no se pudo conectar";
    }

    return $db;
} 

?>