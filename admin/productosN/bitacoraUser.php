<?php 

    require '../../includes/app.php';
    use App\Bitacora;

    // Bitacoras usuarios
    $bUsersInsert = Bitacora::setTable('clientes');
    $bUsersInsert = Bitacora::all();

    incluirTemplate('header');
?>

<h1> Bitacoras Usuarios</h1>
<a href="../" class="boton boton-admin">Volver</a>
        <h3>Insertados</h3>
        <table class="productos">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Fecha</th>
                    <th>sentencia</th>
                    <th>contrasentencia</th>
                </tr>
            </thead>
    
            <tbody> <!-- Mostrar los resultados -->
                <?php foreach( $bUsersInsert as $acciones ): ?>
                <tr>
                    <td><?php echo $acciones->id; ?></td>
                    <td><?php echo $acciones->fecha; ?></td>
                    <td> <?php echo $acciones->sentencia; ?></td>
                    <td> <?php echo $acciones->contrasentencia; ?></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>