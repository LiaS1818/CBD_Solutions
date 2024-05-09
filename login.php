<?php

 require_once 'includes/app.php';

    $db = conectarBD();


    $email = '';
    $password = '';

    $errores = [];

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        
        $email = mysqli_real_escape_string($db, filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) ;
        $password = mysqli_real_escape_string($db, $_POST['password']);

        if (!$email) {
            $errores[] = "El email es obligatorio o no es valido";
        }
        if (!$password) {
            $errores[] = "El password es obligatorio";
        }

        if(empty($errores)){

            //Revisar si el usuario existe
            $query = "SELECT * FROM clientes WHERE  email = '${email}'";
            //Leer los resultados
            $resultado = mysqli_query($db, $query);

            var_dump($resultado);

            //Comprobar que hay resultados en la consulta
            if ($resultado ->num_rows) {
                //Comprobar que la contrasena sea correcta
                $usuario = mysqli_fetch_assoc($resultado);

                //Verificar si el password es correcto o no
                $auth = password_verify($password, $usuario['contrasena']);
                var_dump($auth);
                 if ($auth) {
                   //El usario esta autenticado
                   session_start();
              
                   // Llenar el arreglo de la sesion
                   $_SESSION['usuario'] = $usuario['email'];
                   $_SESSION['login'] = true;
                   $_SESSION['id'] = $usuario['id'];

                   header('Location: /CBD_Solutions/productos.php');

                }else {
                    $errores = "El password es incorrecto";
                }
            }else{
                $errores[] = "El usuario no existe";
            }
        }
    }
?>


<?php
    incluirTemplate('header');
?>

    <div class="contenedor_form" >
        
        <form class="formulario sombra" action="login.php" method="POST" >

            <?php foreach ($errores as $error): ?>
                <div class="alerta error">
                    <?php echo $error ?>
                </div>
            <?php endforeach; ?>

                <fieldset>
                    <legend>Login</legend>
                    <div class="contenedor-campos"><!-- Este campo nos ayudará a editar cada uno por individual-->
        
                        <div class="campo">
                            <label>Correo</label>
                            <input class="input-text" type="email" placeholder="Tu email" name="email" require >
                        </div>
                        
                        <div class="campo">
                            <label>Contraseña</label>
                            <input  class="input-text" type="password" placeholder="Tu constraseña" name="password" require>
                        </div>
                    </div> <!-- Contenedor de los campos-->
                    <div class="contenedor_boton"> <!-- Dos clases-->
                        <input class="boton-admin" type="submit" value="Entrar" name="send">
                    </div>
                </fieldset>
        </form>
    </div>
    <br><br><br><br><br><br><br><br><br><br><br>
    <section class="relleno"></section>

    <?php
    incluirTemplate('footer');
    ?>


</body>
</html>