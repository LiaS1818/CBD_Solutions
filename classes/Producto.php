<?php

namespace App;

class Producto extends ActiveRecord {
     
    protected static $tabla = 'productos';
    protected static $columnasDB =  ['id_producto', 'nombre', 'precio', 'descripcion', 'imagen'];

    public $id_producto;
    public $nombre;
    public $precio;
    public $descripcion;
    public $imagen;


        
    public function __construct($args = [])
    {
        $this->id_producto = $args['id_producto'] ?? null; //place holders
        $this->nombre = $args['nombre'] ?? '';
        $this->precio = $args['precio'] ?? '';
        $this->descripcion = $args['descripcion'] ?? '';
        $this->imagen = $args['imagen'] ?? '';
    }
    public static function obtenerCantidadProductos($idS) {
        $query = "SELECT productos.id_producto, productos.nombre, productos.precio, productos.descripcion, carrito_usuarios.cantidad
        FROM productos
        LEFT JOIN carrito_usuarios ON productos.id_producto = carrito_usuarios.id_producto
        WHERE carrito_usuarios.id_sesion = '$idS';
        ";
    
        $resultado = self::consultarSQL($query);

        return $resultado;
    }

    public static function sumarProductos($idProducto, $idS) {
        $cantidad = 0;
        $productos = self::obtenerCantidadProductos($idS);
        foreach ($productos as $product) {
            if ($product->id_producto == $idProducto) {
                $cantidad = $product->cantidad;
            }
        }
        $cantidad++;
        // Preparar la consulta con marcadores de posición
        $query = "UPDATE carrito_usuarios SET cantidad = $cantidad
                                   WHERE id_producto = $idProducto";            
        $resultado = self::$db->query($query);
        
        return $resultado;
    }
}