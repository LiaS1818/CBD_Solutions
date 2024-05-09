<?php

namespace App;

class Concentracion extends ActiveRecord {

    protected static $tabla = 'concentraciones';
    protected static $columnasDB = ['id', 'cantidad', 'precio', 'dispo'];

    public $id;
    public $cantidad;
    public $precio;
    public $dispo;

        
    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? null; //place holders
        $this->cantidad = $args['cantidad'] ?? '';
        $this->precio = $args['precio'] ?? '';
        $this->dispo = $args['dispo'] ?? '';
    }
    

}