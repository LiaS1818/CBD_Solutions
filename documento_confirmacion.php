<?php
    use App\Usuario;
    use App\Producto;
    session_start();
    $id_sesion = session_id();
    $user = Usuario::findByUser($_SESSION['id']);
    $productos = Producto::obtenerCantidadProductos($id_sesion);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<style>
body {
    font-family: Arial, sans-serif;
}
.container {
    width: 80%;
    margin: auto;
}
.header {
    text-align: center;
    padding: 20px 0;
    background-color: #15c31a;
}
.content {
    padding: 20px;
}
.footer {
    text-align: center;
    padding: 10px 0;
    background-color: #15c31a;
}
</style>
</head>
<body>
<div class="container">
<div class="header">
    <h1>Confirmación de Compra en  Green Vitality CBD Solutions</h1>
</div>
<div class="content">

    <p>Estimado/a <?php echo $user->nombre ?>,</p>
    <p>Telefono: <?php echo $user->telefono ?>,</p>
    <p>Email: <?php echo $user->email ?>,</p>
    <p>Gracias por realizar tu compra. A continuación, te proporcionamos los detalles de la transacción:</p>
    <h3>Insertados</h3>
        <table class="productos">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>nombre</th>
                    <th>precio</th>
                    <th>foto</th>
                </tr>
            </thead>
    
            <tbody> <!-- Mostrar los resultados -->
                <?php foreach( $productos as $acciones ): ?>
                <tr>
                    <td><?php echo $acciones->id_producto; ?></td>
                    <td><?php echo $acciones->nombre; ?></td>
                    <td> <?php echo $acciones->precio; ?></td>
                    <td> <?php echo $acciones->imagen; ?></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <p>¡Esperamos que disfrutes tu compra!</p>
</div>
<div class="footer">
    <p>Gracias por elegirnos.</p>
</div>
</div>
</body>
</html>

