<?php

    // //Validar que sea un id valido
    $id = $_GET['id'];
    $id = filter_var($id, FILTER_VALIDATE_INT);

    if (!$id) {
        header('Location: /CBD_Solutions/index.php');
    }

    // //Base de datos
    require 'includes/app.php';
    $db = conectarBD();

    // // Obtener los datos de los productos
    $consulta = "SELECT * FROM productos WHERE id_producto = ${id}";
    $resultado = mysqli_query($db, $consulta);
    $producto = mysqli_fetch_assoc($resultado);

    // echo "<pre>";
    // var_dump($producto);
    // echo "</pre>";
?>


<?php
    incluirTemplate('header');
?>

<main class="contenedor">
        <h1> <?php echo $producto['nombre']; ?></h1>

    <div class="producto__ver">
            <img class="producto__imagen" src="imagenes/<?php echo $producto['imagen']; ?>" alt="Imagen del producto">

            <div class="producto__contenido">
                <p>
                    <?php echo $producto['descripcion']; ?>
                </p>
                
                <form class="formulario__producto">
                    <select class="formulario__campo">
                        <option disabled selected>-- Concentracion --</option>
                        <option class="formulario__talla">500 mg</option>
                        <option class="formulario__talla">1000 mg</option>
                        <option class="formulario__talla">2000 mg </option>
                    </select>
                    <input class="formulario__campo" type="number" placeholder="Cantidad" min="1"> <!-- No numeros negativos-->
                    <input class="formulario__submit" type="submit" value="Agragar al carrito">
                </form>
            </div>
        </div>
    </main>

<?php
    incluirTemplate('footer');
?>