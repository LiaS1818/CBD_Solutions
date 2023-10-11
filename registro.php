<?php
    require 'includes/app.php';
    $db =conectarBD();
    
    //Arreglo de mensajes de errores
    $errores = [];

    $nombre = ''; 
    $apellido = '';
    $email = '';
    $contrasena = '';
    $telefono = '';
    $nacimiento = '';

    // Ejecutar el código después de que el usuario envia el formulario
    if($_SERVER['REQUEST_METHOD'] === 'POST'){
        // echo "<pre>";
        // var_dump($_POST); //super global
        // echo "<pre>";
        //asignando el contenido a la variable
        $nombre = mysqli_real_escape_string( $db,$_POST['nombre'] );  //sanitizando las entradas del formulario
        $apellido = mysqli_real_escape_string($db,$_POST['apellido']);
        $email = mysqli_real_escape_string( $db,$_POST['email']);
        $contrasena = mysqli_real_escape_string($db, $_POST['contrasena']);
        $telefono = mysqli_real_escape_string($db, $_POST['telefono']);
        $nacimiento = mysqli_real_escape_string($db, $_POST['nacimiento']);
        $creado = date('y/m/d');
        
        if(!$nombre) {
            $errores[] = "Debes agregar un nombre";
        }

        if(!$apellido) {
            $errores[] = "Debes agregar un apellido";
        }
        
        if(!$email) {
            $errores[] = "Debes agregar un correo";
        }

        if(!$contrasena) {
            $errores[] = "Debes agregar una contraseña";
        }
        
        if(!$nacimiento) {
            $errores[] = "Tu fecha de nacimiento es obligatoria";
        }
        
        if(!$telefono) {
            $errores[] = "Debes agregar un telefono";
        }


        // Revisar que el arreglo de errores este vacio
    
        if(empty($errores)) {

            // Hashear el password
            $passwordHash = password_hash($contrasena, PASSWORD_DEFAULT);

            
            
            // Insertar en la base de datos
            $query = " INSERT INTO clientes (nombre, apellido, email, contrasena, telefono, nacimiento) VALUES ('$nombre', '$apellido', 
            '$email', '$passwordHash', '$telefono', '$nacimiento')";

            $resultado = mysqli_query($db, $query);

            if($resultado){
                echo "insetado correctamente";
            }
        }
        
    }

    incluirTemplate('header');
?> 
    <!-- Formulario de registro de clientes -->
    <form action="registro.php" method="POST" class="formulario sombra">  
        <fieldset>
            <legend>Registro de usuraio</legend>
             <!-- Iterando el arreglo para var si hay algun error dentro guardado -->
                <?php foreach($errores as $error):  ?> 
                    <div class="alerta error" >
                        <?php echo $error; ?>
                    </div>
                <?php endforeach; ?>  
            <div class="contenedor-campos"><!-- Este campo nos ayudará a editar cada uno por individual-->
                <div class="campo">
                    <label>Nombre</label>
                    <input class="input-text" type="text" name="nombre"placeholder="Tu Nombre" value="<?php echo $nombre ?>">
                </div>
                <div class="campo">
                    <label>Apellido</label>
                    <input class="input-text" type="text" name="apellido" placeholder="Tu Apellido" value="<?php echo $apellido ?>">
                </div>

                <div class="campo">
                    <label>Correo</label>
                    <input class="input-text" type="email" name="email" placeholder="Tu email" value="<?php echo $email ?>">
                </div>
                
                <div class="campo">
                    <label>Contraseña</label>
                    <input  class="input-text" type="password" name="contrasena" placeholder="Tu constraseña" value="<?php echo $contrasena?>">
                </div>
                <div class="campo">
                    <label>Teléfono</label>
                    <input class="input-text" type="text" name="telefono"  onkeypress='return event.charCode >= 48 && event.charCode <= 57;' value="<?php echo $telefono ?>" >
                </div>
                <div class="campo">
                    <label>Fecha de Nacimiento</label>
                    <input  class="input-text" name="nacimiento" type="date" value="<?php echo $nacimiento ?>">
                </div>
            </div> <!-- Contenedor de los campos-->
            <div class="contenedor_boton"> <!-- Dos clases-->
                <input class="boton w-ms-100" type="submit" value="Eniviar">
            </div>
        </fieldset>
    </form>

    <section class="relleno"></section>

<?php
    incluirTemplate('footer');
?>