
<?php

function conectarBD() : mysqli {
    $db = mysqli_connect('localhost', 'root', '', 'appcdbsolu');

    if (!$db) {
        echo "Error no se pudo conectar";
    }

    return $db;
}

?>