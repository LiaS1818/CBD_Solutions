<?php 

    require '../../includes/app.php';
    $auth = estaAutenticado();

    if (!$auth) {
        header ( 'Location: /CBD_Solutions');
    }

    //Validar que sea un id valido
    $id = $_GET['id'];
    $id = filter_var($id, FILTER_VALIDATE_INT);

    if(!$id){
        header('Location: /CBD_Solutions/admin');
    }

    // Base de datos
    $db = conectarBD();

    // Obtener los datos de los productos
    $consulta = "SELECT * FROM productos WHERE id_producto = ${id}";
    $resultado = mysqli_query($db, $consulta);
    $producto = mysqli_fetch_assoc($resultado);

    echo "<pre>";
    var_dump($producto); 
    echo "</pre>";
    

    // Arreglo para mensajes de errores
    $errores = [];

    $nombre = $producto['nombre'];
    $precio = $producto['precio'];
    $descripcion = $producto['descripcion'];
    $imagenProducto = $producto['imagen'];

    // Ejecutar el código después de que el usuario envia el formulario
    if($_SERVER['REQUEST_METHOD'] === 'POST'){


        //  echo "<pre>";
        //  var_dump($_FILES);
        //  echo "</pre>";

         echo "<pre>";
         var_dump($_POST);
         echo "</pre>";

         // Flta sanitizar estas variables
        $nombre = $_POST['nombre'];
        $precio = $_POST['precio'];
        $descripcion = $_POST['descripcion'];

        //Asignar files hacia una variable
        
        $imagen = $_FILES['imagen'];
        // var_dump($imagen['name']) imprime lo que haya dentro de name en el arreglo llenado con informacion de la imagen

        if (!$nombre) {
            $errores[] = "Debes agregar un titulo";
        }
        if (!$precio) {
            $errores[] = "Debes agregar un precio";
        }
        if (!$descripcion) {
            $errores[] = "Debes agregar una descripcion";
        }

        //Validar por tamaño (1mb máximo)
        $medida = 1000 * 1000;

        if ($imagen['size'] > $medida) {
            $errores[] = "La imagen es muy pesada";
        }


        if (empty($errores)) {
            
            //Crear carpeta
            $carpetaImagenes = '../../imagenes/';
            
            if (!is_dir($carpetaImagenes)) { //Pregunta si existe la carpeta 
                mkdir($carpetaImagenes);
            }

            $nombreImagen = '';
            
            /** SUBIDA DE ARCHIVOS **/ 
            
            if ($imagen['name']) { //imagen en su campo name    
                //Eliminar imagen previa
                unlink($carpetaImagenes . $producto['imagen']);
 
                // Generar un nombre único para imagnees
                $nombreImagen = md5(uniqid( rand(), true)) .".jpg";
    
                // Subir la imagen al servidor
                move_uploaded_file($imagen['tmp_name'], $carpetaImagenes . $nombreImagen);
            }else {
                $nombreImagen = $producto['imagen']; //sera igual a la imagen previa
            }

            
            // Insertar en la base de datos
            $query = " UPDATE productos SET nombre = '${nombre}', precio = ${precio}, descripcion = '${descripcion}', imagen = '${nombreImagen}' WHERE id_producto = ${id}";
            $resultado = mysqli_query($db, $query);

            if ($resultado) {
                //Redireccionar al usuario
                header('Location: ../?resultado=2');
            }
        }

        

    }

     incluirTemplate('header');
?>

    <main class="contenedor seccion">
        <h1>Actualizar Producto</h1>
        
        <a href="../" class="boton boton-admin">Volver</a>
    <!-- enctype funciona para hacerle saber al form que se pueden capturar archivos -->
        <form method="POST" class="formulario sombra" enctype="multipart/form-data"> 
            <!-- Grupo de Campos -->
            <fieldset> 

                <?php foreach($errores as $error):  ?> 
                    <div class="alerta error" >
                        <?php echo $error; ?>
                    </div>
                <?php endforeach; ?>

                <div class="contenedor-campos">
                    <legend>Informacion del Producto</legend>

                    <!-- Name permite leer los valores que el usuario escriba -->
                    <label for="nombre">Nombre:</label>
                    <input type="text" name="nombre" id="nombre" placeholder="Titulo del Producto" value="<?php echo $nombre ?>">

                    <label for="precio">Precio:</label>
                    <input type="number" id="precio" name="precio", placeholder="Precio del Producto" value="<?php echo $precio ?>">

                    <label for="imagen">Imagen:</label>
                    <input type="file" id="imagen" accept="image/jpeg , image/png" name="imagen" value="">

                    <img src="../../imagenes/<?php echo $imagenProducto ?>" alt="" class="imagen-small">

                    <label for="descripcion">Descripcion:</label>
                    <textarea id="descripcion" name="descripcion"><?php echo $descripcion ?></textarea>

                    <div class="contenedor_boton">
                        <input type="submit" class="boton w-ms-100" value="Enviar" href="../">
                    </div>
                </div>

            </fieldset>
        </form>
    </main>
<?php
    incluirTemplate('footer');
?>