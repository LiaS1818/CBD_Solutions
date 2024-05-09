
<?php
    require 'includes/app.php';
     incluirTemplate('header');
?>

    <div class="video">
        <div class="overlay">
            <!-- Tiene que estar dentro del div de video para encimarlo correctamente -->
            <div class="contenedor contenido-video"> 
                <h2> Green Vitality CBD Solutions </h2>
                <p>Octubre 2023, Tlaquepaque México </p>
            </div>
            
        </div>
        <video autoplay muted loop>
            <source src="video/video_empresa.mp4" type="video/mp4" >
        </video>
    </div>

    <section class="contenedor sobre-empresa">
    
        <div class="imagen">
            <img src="img/imagen-cbd.png" alt="Imagen Vacalista Festival">
        </div>
        <div class="contenido-empresa">
            <h2>Green Vitality CBD Solutions</h2>
            <p class="quienes">¿Quienes somos?</p>
            <p>Somos una Startup que se enfoca en la creación de productos de alta calidad con CBD para brindar a nuestros clientes una experiencia gastronómica única y saludable. Nos enfocamos en la calidad, la innovación, la salud y la sostenibilidad para ofrecer una opción única en el mercado de la comida saludable y el CBD.</p>
        </div>
    </section>

    <div class="grid">
        <div class="contenidoMVV">
            <h3> Misión </h3>
            <p>En Green Vitality CBD Solutions , nos apasiona crear salsas y productos con ingredientes de alta calidad, incluyendo el CBD. Creemos que la combinación del CBD y los sabores únicos de nuestros productos pueden ofrecer una experiencia gastronómica única y beneficiosa para nuestros clientes.</p>
        </div>
        <div class="contenidoMVV">
            <h3> Visión</h3>
            <p> Queremos ser reconocidos como líderes en la creación de productos de alta calidad con CBD, brindando a nuestros clientes una experiencia única y saludable en cada bocado.</p>
        </div>
        <div class="contenidoMVV">
            <h3>Valores</h3>
            <p> Calidad: <br> Nos comprometemos a usar ingredientes de la más alta calidad en cada una de nuestros productos 
            Innovación: Estamos siempre explorando nuevas formas de incorporar el CBD en nuestros productos y mejorar la experiencia gastronómica de nuestros clientes.</p>
            <p> Salud: <br> Creemos en la importancia de llevar una vida saludable, y por eso nos aseguramos de que nuestros productos con CBD sean una opción saludable y nutritiva para nuestros clientes.</p>
            <p>Sostenibilidad: <br> Nos preocupamos por el medio ambiente, por lo que nos esforzamos en utilizar envases y materiales sostenibles.</p>
        </div>
    </div>

    <div class="grid">
        <php? 
    </div>


    
    
</body>
<?php
    incluirTemplate('footer');
?>
</html>