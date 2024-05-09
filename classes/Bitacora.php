<?php

namespace App;

class Bitacora extends ActiveRecord {

    protected static $tabla = '';
    protected static $columnasDB = ['id', 'fecha', 'sentencia', 'contrasentencia'];

    public $id;
    public $fecha;
    public $sentencia;
    public $contrasentencia;

    
    public static function setTable($tabla){
        self::$tabla = $tabla;
    }

}