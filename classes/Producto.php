<?php 

namespace App;

class Producto{
    
    //Base de  DATOS

    protected static $db;

    public $id_producto;
    public $nombre;
    public $precio;
    public $descripcion;
    public $imagen;

    public function __construct($args = [])
    {
        $this->id_producto = $args['id_producto'] ?? '';
        $this->nombre = $args['nombre'] ?? '';
        $this->precio = $args['precio'] ?? '';
        $this->descripcion = $args['descripcion'] ?? '';
        $this->imagen = $args['imagen'] ?? '';
    }

    public function save() {
        $query = " INSERT INTO productos (nombre, precio, descripcion, imagen) VALUES 
            ('$this->nombre', '$this->precio', '$this->descripcion', '$this->imagen')";
    }

    //Definir la conexion a la base de datos
    // public static
}