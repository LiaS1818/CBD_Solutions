<?php
require '../../includes/app.php';

use App\Producto;
use Intervention\Image\ImageManagerStatic as Image;
   estaAutenticado();

    //Validar que sea un id valido
    $id = $_GET['id'];
    $id = filter_var($id, FILTER_VALIDATE_INT);

    if(!$id){
        header('Location: /CBD_Solutions/admin');
    }

    // Obtener los datos de los productos
    $producto = Producto::find($id);

    // Arreglo para mensajes de errores
    $errores = Producto::getErrores();

    // Ejecutar el código después de que el usuario envia el formulario
    if($_SERVER['REQUEST_METHOD'] === 'POST'){

        // Asignar los atributos
        $argc = $_POST['producto'];
        
        $producto->sincronizar($argc);
        
        // Generar un nombre único para imagnees
        $nombreImagen = md5(uniqid( rand(), true)) .".jpg";

        // Setear la imagen
        // Realiza un resize a la imagen con intervention 
        if($_FILES['producto']['tmp_name']['imagen']){
            $imagen = Image::make($_FILES['producto']['tmp_name']['imagen'])->fit(800,600); //Archivo
            $producto->setImage($nombreImagen);

        }
        if (empty($errores)) {
            //Almacenar la imagen solo si hay una nueva imagen
            if($_FILES['producto']['tmp_name']['imagen']){
            $imagen->save(CARPETA_IMAGENES . $nombreImagen);
            }
            $producto->guardar();   
            // $imagen->save(CARPETA_IMAGENES . $nombreImagen);
            
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
                <?php include '../../includes/templates/formulario_productos.php'?>
            </fieldset>
            <div class="contenedor_boton"> <!-- Dos clases-->
                <input class="boton-admin" type="submit" value="OK">
            </div>
        </form>
    </main>
<?php
    incluirTemplate('footer');
?>