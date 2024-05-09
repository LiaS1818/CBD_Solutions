<div class="contenedor-campos">
    <legend>Informacion del Producto</legend>

    <!-- Name permite leer los valores que el usuario escriba -->
    <label for="nombre">Nombre:</label>
    <input type="text" name="producto[nombre]" id="nombre" placeholder="Titulo del Producto" value= "<?php 
    echo s($producto->nombre) ?>">

    <label for="precio">Precio:</label>
    <input type="number" id="precio" name="producto[precio]", placeholder="Precio del Producto" value= "<?php echo s($producto->precio) ?>"> 

    <label for="imagen">Imagen:</label>
    <input type="file" id="imagen" accept="image/jpeg , image/png" name="producto[imagen]">

    <?php if($producto->imagen) {?>
        <img src="/CBD_Solutions/imagenes/<?php echo $producto->imagen ?>" class="imagen-small"> 
    <?php } ?>
    <label for="descripcion">Descripcion:</label>
    <textarea id="descripcion" name="producto[descripcion]"><?php echo s($producto->descripcion); ?></textarea>
</div>