<?php
require 'includes/app.php';
    
    incluirTemplate('header');
?>

<main class="contenedor">
    <h1>Buscanos en la siguiente direccion o envianos un correo </h1>
    <div id="mapa">

    <script>
        function inicializarMapa() {
        var ubicacion = { lat: -34.603722, lng: -58.381592 }; // Latitud y longitud de la ubicación inicial
        var mapa = new google.maps.Map(document.getElementById('mapa'), {
            zoom: 15, // Nivel de zoom
            center: ubicacion // Centro del mapa en la ubicación especificada
        });
        var marcador = new google.maps.Marker({
            position: ubicacion,
            map: mapa,
            title: 'Mi Ubicación' // Texto que aparecerá al hacer clic en el marcador
        });
        }
    </script>

    </div>

        <h3 class="centrar-texto">Contacto</h3>

        <div class="contacto-bg"></div>

        <form class="formulario" action="contacto.php" method="post">
            <div class="campo">
                <label class="campo__label" for="nombre">Nombre</label>
                <input 
                    class="campo__field"
                    type="text" 
                    placeholder="Tu Nombre" 
                    id="nombre"
                >
            <div class="campo">
                <label class="campo__label" for="mensaje">Mensaje</label>
                <textarea 
                    class="campo__field campo__field--textarea"
                    id="mensaje"
                ></textarea>
            </div> 
            
            <div class="campo">
                <input type="submit" class="boton boton--primario" name="send" value="Enviar" >
            </div>
            
        </form>
        
    </main>