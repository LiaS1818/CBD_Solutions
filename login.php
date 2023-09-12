<?php
    require 'includes/funciones.php';
    incluirTemplate('header');
?>

    <div class="contenedor_form">
        <form class="formulario sombra">
            <fieldset>
                <legend>Login</legend>
                <div class="contenedor-campos"><!-- Este campo nos ayudará a editar cada uno por individual-->
    
                    <div class="campo">
                        <label>Correo</label>
                        <input class="input-text" type="email" placeholder="Tu email">
                    </div>
                    
                    <div class="campo">
                        <label>Contraseña</label>
                        <input  class="input-text" type="password" placeholder="Tu constraseña">
                    </div>
                </div> <!-- Contenedor de los campos-->
                <div class="contenedor_boton"> <!-- Dos clases-->
                    <input class="boton w-ms-100" type="submit" value="Eniviar">
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