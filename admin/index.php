<?php 
    
    require '../includes/app.php';
    // $auth = estaAutenticado();
    // if (!$auth) {
    //     header ( 'Location: /CBD_Solutions');
    // }
    // Importar la conexion
    $db = conectarBD();

    // Escribir el Query
    $query = "SELECT * FROM productos";

    // Consultar la BD
    $resultadoConsulta = mysqli_query($db, $query);

    //Muestra mensaje condicional
    $resultado = $_GET['resultado'] ?? null; //placeholder: busca el valor y si no lo encuentra le asigna el valor por default

    if ($_SERVER['REQUEST_METHOD'] === 'POST') { //revisar el request mthod, post porque enviamos el formulario via POST
        $id = $_POST['id'];
        $id = filter_var($id, FILTER_VALIDATE_INT);

        if ($id) {

            // Eliminar el archivo
            $query = "SELECT imagen FROM productos WHERE id_producto = ${id}"; 

            $resultado = mysqli_query($db, $query);
            $producto = mysqli_fetch_assoc($resultado); // asigna el resultado obtenido del mysqli_query 

            unlink('../imagenes/' . $producto['imagen']);
            // Eliminar el producto
            $query = "DELETE FROM productos WHERE id_producto = ${id}";

            $resultado = mysqli_query($db, $query); //instacia de la conexion y query

            if ($resultado) {
                header('location: /CBD_Solutions/admin?resultado=3');
            }
        }

    }

    //incluye un tamplate
    incluirTemplate('header');
?>

    <main class="contenedor">
        <h1>Administrador</h1>
        <?php if(intval($resultado) === 1): ?>
            <p class="alerta exito">Producto creado correctamente</p>
        <?php elseif ( intval($resultado) === 2): ?>
            <p class="alerta exito">Producto Actualizado Correctamente</p>
        <?php endif; ?>
        <?php if ( intval($resultado) === 3): ?>
            <p class="alerta exito">Producto Eliminado Correctamente</p>
        <?php endif; ?>
        <a href="productosN/crear.php" class="boton-admin    ">Crear nuevo producto</a>

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
                <?php while( $producto = mysqli_fetch_assoc($resultadoConsulta)): ?>
                <tr>
                    <td><?php echo $producto['id_producto']; ?></td>
                    <td><?php echo $producto['nombre']; ?></td>
                    <td><img  class="imagen-tabla" src="../imagenes/<?php echo $producto['imagen']; ?>" alt=""></td>
                    <td> $ <?php echo $producto['precio']; ?></td>
                    <td>
                        <form method="POST" class="w-100">

                            <input type="hidden" name="id" value=" <?php echo $producto['id_producto']; ?>"> 
                            <!-- enviar datos de forma oculta -->
                            <input type="submit" class="boton-rojo-block" value="Eliminar">
                        </form>
                        <a href="/CBD_Solutions/admin/productosN/actualizar?id=<?php echo $producto['id_producto']; ?>" class="boton-amarillo-block">Actualizar</a>
                    </td>
                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </main>


<?php
    // Cerrar la conexion
    mysqli_close($db);
    incluirTemplate('footer');
?>