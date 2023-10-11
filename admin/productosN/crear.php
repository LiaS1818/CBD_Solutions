<?php 
    require '../../includes/app.php';

    use App\Producto;

    

    estaAutenticado();

    

    $db = conectarBD();

    $errores = [];

    $nombre = '';
    $precio = '';
    $descripcion = '';

    if($_SERVER['REQUEST_METHOD'] === 'POST'){

        // $producto = new Producto($_POST);
        // $producto->save();
        // debuguear($producto);

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
        if (!$imagen['name'] || $imagen['error']) {
            $errores[] = "La imagen es obligatoria";
        }

        //Validar por tamaño (1mb máximo)
        $medida = 1000 * 1000;

        if ($imagen['size'] > $medida) {
            $errores[] = "La imagen es muy pesada";
        }


        if (empty($errores)) {
            
            /** Subida de archivos **/ 
            
            //Crear carpeta
            $carpetaImagenes = '../../imagenes/';

            if (!is_dir($carpetaImagenes)) { //Pregunta si existe la carpeta 
                mkdir($carpetaImagenes);
            }

            // Generar un nombre único para imagnees
            $nombreImagen = md5(uniqid( rand(), true)) .".jpg";

            // Subir la imagen al servidor
            move_uploaded_file($imagen['tmp_name'], $carpetaImagenes . $nombreImagen);
    
            $query = " INSERT INTO productos (nombre, precio, descripcion, imagen) VALUES 
            ('$nombre', '$precio', '$descripcion', '$nombreImagen')";

            $resultado = mysqli_query($db, $query);

            if ($resultado) {
                //Redireccionar al usuario
                header('Location: ../?resultado=1');
            }
        }

        

    }

     incluirTemplate('header');
?>

    <main class="contenedor seccion">
        <h1>Crear producto</h1>
        
        <a href="../" class="boton boton-admin">Volver</a>
    <!-- enctype funciona para hacerle saber al form que se pueden capturar archivos -->
        <form method="POST" class="formulario sombra" action="crear.php" enctype="multipart/form-data"> 
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
                    <input type="text" name="nombre" id="nombre" placeholder="Titulo del Producto" value= "<?php echo $nombre ?>">

                    <label for="precio">Precio:</label>
                    <input type="number" id="precio" name="precio", placeholder="Precio del Producto" value= "<?php echo $precio ?>"> 

                    <label for="imagen">Imagen:</label>
                    <input type="file" id="imagen" accept="image/jpeg , image/png" name="imagen">

                    <label for="descripcion">Descripcion:</label>
                    <textarea id="descripcion" name="descripcion"></textarea>

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