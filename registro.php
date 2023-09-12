<?php
    require 'includes/config/database.php';
    $db =conectarBD();
    
    //Arreglo de mensajes de errores
    $errores = [];
    // Ejecutar el código después de que el usuario envia el formulario
    if($_SERVER['REQUEST_METHOD'] === 'POST'){
        // echo "<pre>";
        // var_dump($_POST); //super global
        // echo "<pre>";
        //asignando el contenido a la variable
        $nombre = $_POST['nombre']; 
        $apellido = $_POST['apellido'];
        $email = $_POST['email'];
        $contrasena = $_POST['contrasena'];
        $telefono = $_POST['telefono'];
        $nacimiento = $_POST['nacimiento'];

        if(!$nombre) {
            $errores[] = "Debes agregar un nombre";
        }

        if(!$apellido) {
            $errores[] = "Debes agregar un correo";
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
            // Insertar en la base de datos
            $query = " INSERT INTO clientes (nombre, apellido, email, contrasena, telefono, nacimiento) VALUES ('$nombre', '$apellido', 
            '$email', '$contrasena', '$telefono', '$nacimiento')";

            $resultado = mysqli_query($db, $query);

            if($resultado){
                echo "insetado correctamente";
            }
        }
        
    }

    require 'includes/funciones.php';
    incluirTemplate('header');
?>
    <!-- Formulario de registro de clientes -->

    

    <form action="registro.php" method="POST" class="formulario sombra" action>
        <fieldset>
            <legend>Registro de usuraio</legend>
            <div class="contenedor-campos"><!-- Este campo nos ayudará a editar cada uno por individual-->
                <div class="campo">
                    <label>Nombre</label>
                    <input class="input-text" type="text" name="nombre"placeholder="Tu Nombre">
                </div>
                <div class="campo">
                    <label>Apellido</label>
                    <input class="input-text" type="text" name="apellido" placeholder="Tu Apellido">
                </div>

                <div class="campo">
                    <label>Correo</label>
                    <input class="input-text" type="email" name="email" placeholder="Tu email">
                </div>
                
                <div class="campo">
                    <label>Contraseña</label>
                    <input  class="input-text" type="password" name="contrasena" placeholder="Tu constraseña">
                </div>
                <div class="campo">
                    <label>Teléfono</label>
                    <input class="input-text" type="text" name="telefono"  onkeypress='return event.charCode >= 48 && event.charCode <= 57;'/>
                </div>
                <div class="campo">
                    <label>Fecha de Nacimiento</label>
                    <input  class="input-text" name="nacimiento" type="date">
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