<?php 
    require 'includes/app.php';
    use App\Producto;
    incluirTemplate('header');
    
    $id_sesion = session_id();
    $productos = Producto::obtenerCantidadProductos($id_sesion);
    
?>

<main class="contenedor">
    <?php echo $_SESSION['usuario']; ?>
    <table class="productos">
                    <thead>
                        <tr>
                            <th>Cantidad</th>
                            <th>Nombre</th>
                            <th>Descripción</th>
                            <th>Precio</th>
                            <th>subtotal</th>
                            <th>Quitar</th>
                            <th>Agregar</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $total = 0;
                        foreach ($productos as $producto) {
                            $total += $producto->precio * $producto->cantidad;
                        ?>
                            <tr>
                                    <td><?php echo  $producto->cantidad ?></td>
                                    <td><?php echo $producto->nombre ?></td>
                                    <td><?php echo $producto->descripcion ?></td>
                                    <td>$<?php echo number_format($producto->precio, 2) ?></td> 
                                    <td>$<?php echo number_format(($producto->precio * $producto->cantidad), 2) ?></td>
                                <td>
                                    <form action="eliminar_del_carrito.php" method="post">
                                        <input type="hidden" name="id_producto" value="<?php echo $producto->id_producto ?>">
                                        <input type="hidden" name="redireccionar_carrito">
                                        <button class="boton-rojo-block">
                                        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
                                                <i class="material-symbols-outlined">delete</i> <!-- Icono de casa -->

                                        </button>
                                    </form>
                                </td>
                                <td>
                                    <form action="agregar_cantidad.php" method="post">
                                        <input type="hidden" name="id_producto" value="<?php echo $producto->id_producto ?>">
                                        <input type="hidden" name="redireccionar_carrito">
                                        <button class="boton-rojo-block">
                                            <i > + </i>
                                        </button>
                                    </form>
                                </td>
                            <?php } ?>
                            </tr>
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="2" class="is-size-4 has-text-right"><strong>Total</strong></td>
                            <td colspan="2" class="is-size-4">
                                $<?php echo number_format($total, 2) ?>
                                
                            </td>
                            <td>
                                <form action="contacto.php" method="post">
                                    <input type="submit" class="boton-check" name="send" value="Enviar">
                                </form>
                            </td>
                        </tr>
                    </tfoot>
    </table>
</main>
<?php incluirTemplate('footer'); ?>