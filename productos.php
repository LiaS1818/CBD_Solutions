<?php
    require 'includes/app.php';
    incluirTemplate('header');
?>

<main class="contenedor">
        <h1>Nuestros Productos</h1>
            <?php
                include 'includes/templates/productos.php';
            ?>
        </div>
</main>
<?php
    incluirTemplate('footer');
?>