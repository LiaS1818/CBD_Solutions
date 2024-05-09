<?php 
    require '../includes/app.php';
    estaAutenticado();
    
    use App\Producto;
    use App\Concentracion;
    use App\Bitacora;


    // Implementar un metodo para obtener las propiedades
    $productos = Producto::all();
    $concentraciones = Concentracion::all();
    $bitacoraInsert = Bitacora::setTable('bitacora_pro');
    $bitacoraInsert = Bitacora::all();
    $bitacoraElimi = Bitacora::setTable('bitacoraelminados_pro');
    $bitacoraElimi = Bitacora::all();
    $bitacoraActuali = Bitacora::setTable('bitacoraupdate_pro');
    $bitacoraActuali = Bitacora::all();

    // debuguear($productos);
    
    //Muestra mensaje condicional
    $resultado = $_GET['resultado'] ?? null; //placeholder: busca el valor y si no lo encuentra le asigna el valor por default

    if ($_SERVER['REQUEST_METHOD'] === 'POST') { //revisar el request mthod, post porque enviamos el formulario via POST
        $id = $_POST['id'];
        $id = filter_var($id, FILTER_VALIDATE_INT);

        if ($id) {
            $producto = Producto::find($id);
            // Eliminar el archivo
            $producto->eliminar();
        }
    }

    //incluye un tamplate
    incluirTemplate('header');
?>

    <main class="contenedor">
        <br>
        <h1>Administrador</h1>
        <a href="productosN/bitacoraUser.php" class="boton-admin">Ver bitacora Usuarios</a>
        <?php if(intval($resultado) === 1): ?>
            <p class="alerta exito">Producto creado correctamente</p>
        <?php elseif ( intval($resultado) === 2): ?>
            <p class="alerta exito">Producto Actualizado Correctamente</p>
        <?php endif; ?>
        <?php if ( intval($resultado) === 3): ?>
            <p class="alerta exito">Producto Eliminado Correctamente</p>
        <?php endif; ?>
        <a href="productosN/crear.php" class="boton-admin">Crear nuevo producto</a>

        <table class="productos">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Titulo</th>
                    <th>Imagen</th>
                    <th>Precio</th>
                    <th>Acciones</th>
                </tr>
            </thead>

            <tbody> <!-- Mostrar los resultados -->
                <?php foreach( $productos as $producto ): ?>
                <tr>
                    <td><?php echo $producto->id_producto; ?></td>
                    <td><?php echo $producto->nombre; ?></td>
                    <td><img  class="imagen-tabla" src="../imagenes/<?php echo $producto->imagen; ?>" alt=""></td>
                    <td> $ <?php echo $producto->precio; ?></td>
                    <td>
                        <form method="POST" class="w-100">

                            <input type="hidden" name="id" value=" <?php echo $producto->id_producto; ?>"> 
                            <!-- enviar datos de forma oculta -->
                            <input type="submit" class="boton-rojo-block" value="Eliminar">
                        </form>
                        <a href="/CBD_Solutions/admin/productosN/actualizar?id=<?php echo $producto->id_producto; ?>" class=" ">Actualizar</a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <br>
                    <h1> Bitacoras Productos</h1>
        <h3>Insertados</h3>
        <table class="productos">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Fecha</th>
                    <th>sentencia</th>
                    <th>contrasentencia</th>
                </tr>
            </thead>
    
            <tbody> <!-- Mostrar los resultados -->
                <?php foreach( $bitacoraInsert as $acciones ): ?>
                <tr>
                    <td><?php echo $acciones->id; ?></td>
                    <td><?php echo $acciones->fecha; ?></td>
                    <td> <?php echo $acciones->sentencia; ?></td>
                    <td> <?php echo $acciones->contrasentencia; ?></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <br>
        <h3>Eliminados</h3>
        <table class="productos">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Fecha</th>
                    <th>sentencia</th>
                    <th>contrasentencia</th>
                </tr>
            </thead>
    
            <tbody> <!-- Mostrar los resultados -->
                <?php foreach( $bitacoraElimi as $acciones ): ?>
                <tr>
                    <td><?php echo $acciones->id; ?></td>
                    <td><?php echo $acciones->fecha; ?></td>
                    <td> <?php echo $acciones->sentencia; ?></td>
                    <td> <?php echo $acciones->contrasentencia; ?></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <br>
        <h3>Actualizados</h3>
        <table class="productos">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Fecha</th>
                    <th>sentencia</th>
                </tr>
            </thead>
    
            <tbody> <!-- Mostrar los resultados -->
                <?php foreach( $bitacoraActuali as $acciones ): ?>
                <tr>
                    <td><?php echo $acciones->id; ?></td>
                    <td><?php echo $acciones->fecha; ?></td>
                    <td> <?php echo $acciones->sentencia; ?></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </main>


<?php
    // Cerrar la conexion
    mysqli_close($db);
    incluirTemplate('footer');
?>