<?php
    require 'includes/app.php';
    use App\Producto;
    use App\Concentracion;
    use App\Carrito;
// // Obtener los datos de los productos
session_start();
// //Validar que sea un id valido
$id = $_GET['id'];
$id = filter_var($id, FILTER_VALIDATE_INT);
$id_sesion = session_id();

$producto = Producto::find($id);
$concentraciones = Concentracion::all();
$carrito = new Carrito();
$carritos = Carrito::productoYaEstaEnCarrito($id, $id_sesion);

    if (!$id) {
        header('location: /CBD_Solutions/index.php');
    }
    
?>


<?php
    incluirTemplate('header');
?>

<main class="contenedor">
        <h1> <?php echo $producto->nombre; ?></h1>

    <div class="producto__ver">
            <img class="producto__imagen" src="imagenes/<?php echo $producto->imagen; ?>" alt="Imagen del producto">

            <div class="producto__contenido">
                <p>
                    <?php echo $producto->descripcion; ?>
                </p>
                
                <form method="post" class="formulario__producto" action="agregar_carrito.php" >
                    <input  type="hidden"  name="carrito_usuarios[id_sesion]"  value="<?php echo $id_sesion?>">
                    <input  type="hidden"  name="carrito_usuarios[id_producto]" value="<?php echo $producto->id_producto?>">
                    <select class="formulario__campo" name="carrito_usuarios[concent]">
                        <option disabled selected>-- Concentracion --</option>
                        <?php foreach ( $concentraciones as $consent) : ?>
                            <option  class="formulario__talla"> <?php echo $consent->cantidad . "| $".$consent->precio?></option>
                        <?php endforeach; ?>
                    </select>
                    <input name="carrito_usuarios[cantidad]" class="formulario__campo" type="number" placeholder="Cantidad" min="1"> <!-- No numeros negativos-->
                    <?php if ($carritos) : ?>
                        <div class="boton-check">Ya esta en carrito</div>
                        <?php else : ?>
                            <input class="formulario__submit" type="submit" value="Agregar al CArrito">
                        
                    <?php endif; ?>
                </form>
            </div>
        </div>
    </main>

<?php
    incluirTemplate('footer');
?>