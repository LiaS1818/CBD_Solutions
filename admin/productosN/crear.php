<?php 
    require '../../includes/app.php';

    use App\Producto;
    use Intervention\Image\ImageManagerStatic as Image;

    estaAutenticado();
    $producto = new Producto();

    // Arreglo con mensajes de errores
    $errores = Producto::getErrores();
    

    if( $_SERVER['REQUEST_METHOD'] === 'POST'){
        
        /** Crea una nueva instancia **/
         $producto = new Producto($_POST['producto']);
         
         // debuguear($producto);

         /** SUBIDA DE ARCHIVOS  */

        // Generar un nombre único para imagnees
        $nombreImagen = md5(uniqid( rand(), true)) .".jpg";

        // Setear la imagen
        // Realiza un resize a la imagen con intervention 
        if($_FILES['producto']['tmp_name']['imagen']){
            $imagen = Image::make($_FILES['producto']['tmp_name']['imagen'])->fit(800,600); //Archivo
            $producto->setImage($nombreImagen);
        }

        //Validar
        $errores = $producto->validar();
         
         if (empty($errores)) {
            // Crear la carpeta para subir la imagen al servidor
            if (!is_dir(CARPETA_IMAGENES)) {
                mkdir(CARPETA_IMAGENES);
            }
            //Asignar files hacia una variable
            // $imagen = $_FILES['imagen'];
            // var_dump($imagen['name']) imprime lo que haya dentro de name en el arreglo llenado con informacion de la imagen
             
            //Guarda la imagen en el servidor
            $imagen->save(CARPETA_IMAGENES . $nombreImagen);

            // Guarda en la base de datos
            $producto->guardar();
            
            // // Subir la imagen al servidor, esta era otra manera de realizar la subida
            // move_uploaded_file($imagen['tmp_name'], $carpetaImagenes . $nombreImagen);
    
        }
    }

    incluirTemplate('header');
?>

    <main class="contenedor seccion">
        <h1>Crear producto</h1>
        
        <a href="../ " class="boton boton-admin">Volver</a>
    <!-- enctype funciona para hacerle saber al form que se pueden capturar archivos -->
        <form method="POST" class="formulario sombra" action="crear.php" enctype="multipart/form-data"> 
            <!-- Grupo de Campos -->
            <?php foreach($errores as $error):  ?> 
                <div class="alerta error" >
                    <?php echo $error; ?>
                </div>
                <?php endforeach; ?>
               

                <?php include '../../includes/templates/formulario_productos.php'?>
                
                <div class="contenedor_boton">
                    <input type="submit" class="boton w-ms-100" value="Enviar" >
                </div>
            
        </form>
    </main>
<?php
    incluirTemplate('footer');
?>