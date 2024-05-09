<?php

namespace App;

class Carrito extends ActiveRecord {

    protected static $tabla = 'carrito_usuarios';
    protected static $columnasDB = ['id_sesion', 'id_producto', 'cantidad', 'concent'];

    public $id_sesion;
    public $id_producto;
    public $cantidad = 1;
    public $concent;
    public function __construct($args = [])
    {
        $this->id_sesion = $args['id_sesion'] ?? null; //place holders
        $this->id_producto = $args['id_producto'] ?? '';
        $this->cantidad = $args['cantidad'] ?? '';
        $this->concent = $args['concent'] ?? '';
    }

    public static function productoYaEstaEnCarrito($idProducto, $idS){
        $carrito = Carrito::findId($idS);
        if($carrito){
            foreach($carrito as $id) {
                if($id->id_producto == $idProducto) return true;
            }
        }
        return false;
    }

    public static function findId ($idS){
        $query = "SELECT id_producto FROM " . static::$tabla . " WHERE id_sesion = '$idS'";
         
        $resultado = self::consultarSQL($query);
        
        return $resultado;
    }

    public function getIdProductos ()
    {
        $query = "SELECT id_producto FROM " . static::$tabla ;

        $resultado =self::consultarSQL($query);
    
        return $resultado;
    }

    public static function obtenerIDProductosCarrito($idS) {
        
            $query = "SELECT id_producto FROM " . static::$tabla . " WHERE  id_sesion = '$idS'";
            $resultado =self::consultarSQL($query);
            return $resultado;
    }

    public static function quitarProductoDelCarrito($idProducto, $idS) {
        $query = "DELETE FROM " . static::$tabla . " WHERE id_sesion = '$idS' AND id_producto = $idProducto";
        $resultado = self::$db->query($query);
        return $resultado;

    }
    
}