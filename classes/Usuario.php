<?php

namespace App;

class Usuario extends ActiveRecord {
    protected static $tabla = 'clientes';
    protected static $columnasDB = ['id', 'nombre', 'apellido', 'email', 'telefono', 'nacimiento'];

    public $id;
    public $nombre;
    public $apellido;
    public $email;
    public $telefono;
    public $nacimiento;
        
    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? null; //place holders
        $this->nombre = $args['nombre'] ?? '';
        $this->apellido = $args['apellido'] ?? '';
        $this->email = $args['email'] ?? '';
        $this->telefono = $args['telefono'] ?? '';
        $this->nacimiento = $args['nacimiento'] ?? '';
    }

    public static function findByUser($email){
        $query = "SELECT * FROM " . static::$tabla . " WHERE id = $email";
         
       $resultado = self::consultarSQL($query);

       return array_shift($resultado);
    }

}