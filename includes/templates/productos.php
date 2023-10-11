<?php
    //Importar la conexion
   
    $db = conectarBD();

    // consultar
    $query = "SELECT * FROM productos";

    // obtner resultado
    $resultado = mysqli_query($db, $query);

?>
<div class="gridProductos">
    <?php while($producto = mysqli_fetch_assoc($resultado)) :?>        
            <div class="producto">
                <a href="/CBD_Solutions/producto.php?id=<?php echo $producto['id_producto']; ?>">
                    <img class="producto__imagen" src="imagenes/<?php echo $producto['imagen']; ?>" alt="imagen camisa" loading="lazy">
                    <div class="producto__informacion">
                        <p class="producto__nombre"> <?php echo $producto['nombre']; ?></p>
                        <p class="producto__precio"><?php echo $producto['precio']; ?></p>
                        
                    </div>
                </a>
            </div> <!-- .producto -->
    <?php endwhile ; ?>
</div>
<?php
    //Cerrar la conexion
        mysqli_close($db);
?>


