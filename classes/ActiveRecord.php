<?php 

namespace App;

class ActiveRecord{
    
    //Base de  DATOS
    protected static $db;
    protected static $columnasDB =  [''];
    protected static $tabla = '';

    // Errores
    protected static $errores = [];  //solo la clase pueden modificar la variable

    //Definir la conexion a la base de datos
    public static function setDB($database){
        self::$db = $database;   
    }
    
    public function guardar() {
        if (!is_null($this->id_producto)) {
            // actualizar
            $this->actualizar();
        }else{
            $this->crear();
        }
    }

    public function crear() {

        // Sanitizar atributos
        $atributos = $this->sanitizarAtributos();
      
        //Aplando el arreglo
        //Insertar en la base de datos
        $query = " INSERT INTO " . static::$tabla . " ( ";
        $query .= join(', ', array_keys($atributos)); //join crear un nuevo string apartir de un arreglo
        $query .= " ) VALUES ('";  
        $query .= join("', '", array_values($atributos));   
        $query .= "')";
        
        // $trigger = "
        // DELIMITER //
        // CREATE TRIGGER bitacora_pro
        // AFTER INSERT ON productos
        // FOR EACH ROW
        // BEGIN
        //     INSERT INTO bitacora_pro (fecha, sentencia, contrasentencia)
        //     VALUES (
        //         NOW(),
        //         CONCAT('INSERT INTO productos (id_producto, nombre, precio, descripcion, imagen) VALUES (',
        //                NEW.id_producto, ', \"', NEW.nombre, '\", ', NEW.precio, ', \"', NEW.descripcion, '\", \"', NEW.imagen, '\")'),
        //         CONCAT('DELETE FROM productos WHERE id_producto = ', NEW.id_producto)
        //     );
        // END;
        // //
        // DELIMITER ;
        // ";
        // $triggerE =  "
        // DELIMITER //
        // CREATE TRIGGER bitacoraElminados_pro
        // AFTER DELETE ON productos
        // FOR EACH ROW
        // BEGIN
        //     INSERT INTO bitacoraelminados_pro (fecha, sentencia, contrasentencia)
        //     VALUES (
        //         NOW(),
        //         CONCAT('DELETE FROM productos WHERE id_producto = ', NEW.id_producto),
        //         CONCAT('INSERT INTO productos (id_producto, nombre, precio, descripcion, imagen) VALUES (',
        //                NEW.id_producto, ', \"', NEW.nombre, '\", ', NEW.precio, ', \"', NEW.descripcion, '\", \"', NEW.imagen, '\")')
        //     );
        // END;
        // //
        // DELIMITER ;
        // ";
        
        $resultado = self::$db->query($query);
        // self::$db->query($trigger);
        // self::$db->query($triggerE);
        // Mensaje de exito
        if ($resultado ) {
            //Redireccionar al usuario
            header('Location: ../?resultado=1');
        }
    }

    public function actualizar() {
        // Sanitizar los datos
        $atributos = $this->sanitizarAtributos();

        $valores = []; // ir al objeto en memoria, uniendo atributos con valores
        foreach ($atributos as $key => $value) {
            $valores[] = "{$key}='{$value}'";
        }
        // debuguear(join(',', $valores )); //convierte a un string el arreglo y los separa por comas

        $query = "UPDATE " . static::$tabla . " SET ";
        $query .= join(', ', $valores);
        $query .= " WHERE id_producto = '" . self::$db->escape_string($this->id_producto) . "' ";
        $query .= " LIMIT 1 ";

        $triggerUp = "DELIMITER //

        CREATE TRIGGER bitacoraUpdate_pro
        AFTER UPDATE ON productos
        FOR EACH ROW
        BEGIN
            INSERT INTO bitacorauseractua (fecha, sentencia, contrasentencia)
            VALUES (
                NOW(),
                CONCAT('UPDATE productos SET nombre = \"', NEW.nombre, '\", apellido = ', NEW.apellido, ', email = \"', NEW.email, '\", contrasena = \"', NEW.contrasena, \"', telefono = \", NEW.telefono, '\" WHERE id = ', NEW.id),
                CONCAT('UPDATE productos SET nombre = \"', OLD.nombre, '\", apellido = ', OLD.apellido, ', email = \"', OLD.email, '\", contrasena = \"', OLD.contrasena,  \"', telefono = \", OLD.nombre, '\" WHERE id = ', OLD.id)
            );
        END;
        //
        
        DELIMITER ;";

        $resultado = self::$db->query($query);
        self::$db->query($triggerUp);
        
        if ($resultado) {
            //Redireccionar al usuario
            header('Location: ../?resultado=2');
        }
    }

    // Eliminar un registro
    public function eliminar() {
        $query = "DELETE FROM " . static::$tabla . " WHERE id_producto = " . self::$db->escape_string($this->id_producto) . " LIMIT 1";
        $resultado = self::$db->query($query);
        if ($resultado) {
            $this->eliminarImagen();
            header('location: ?resultado=3');
        }   
    }


    //Identificar y unir los atributos de la BD
    //Iterar el arreglo de atributos
    public function atributos(){
        $atributos = [];
        foreach(static::$columnasDB as $columna){
            // if($columna === 'id_producto') continue;
            $atributos[$columna] = $this->$columna; //hace referecia al objeto en memoria para ir mapeando
        }
        return $atributos;
    }

    public function sanitizarAtributos() {
        $atributos = $this->atributos();
        
        foreach($atributos as $key => $value){
            $sanitizando[$key] = self::$db->escape_string($value);
        } //obtener llave y valor

        return $sanitizando; 
    }

    //Subida de archivos
    public function setImage($imagen){
        //Elimina la imagen previa

        if(!is_null($this->id_producto)) {
            //Comprobar si existe el archivo
           $this->eliminarImagen();
        }
        //Asignar al atributo de imagen el nombre de la imagen
        if ($imagen) {
            $this->imagen = $imagen;
        }
    }

    //Eliminar imagen 
    public function eliminarImagen() {
        $existeArchivo = file_exists(CARPETA_IMAGENES . $this->imagen);
        if($existeArchivo) {
            unlink(CARPETA_IMAGENES . $this->imagen ); 
        }
    }

    //Validacion
    public static function getErrores(){
         return self::$errores;
    }

    public function validar() {
        
        if (!$this->nombre) {
            self::$errores[] = "Debes agregar un titulo";
        }
        if (!$this->precio) {
            self::$errores[] = "Debes agregar un precio";
        }
        if (!$this->descripcion) {
            self::$errores[] = "Debes agregar una descripcion";
        }
        if (!$this->imagen) {
             self::$errores[] = "La imagen es obligatoria";
        }

        return self::$errores;
    }

    // Lista todos los registros
    public static function all(){
        $query = "SELECT * FROM " . static::$tabla ;

        $resultado =self::consultarSQL($query);
    
        return $resultado;
    }

    // Busca un registro por su id
    public static function find($id){
        $query = "SELECT * FROM " . static::$tabla . " WHERE id_producto = ${id}";
         
       $resultado = self::consultarSQL($query);

       return array_shift($resultado);
    }



    public static function consultarSQL($query) {
        // Consultar la base de datos
        $resultado = self::$db->query($query);
        
        //Iterar los resultados
        $array = [];
        while($registro = $resultado->fetch_assoc()){ //fetch assoc trae los registro de la base de datos

            $array[] = static::crearObjeto($registro); // se llena el arreglo con objetos creados
        }
        // Liberar la memoria
        $resultado->free();
        //Retornar los resultados
        return $array;
    }

    protected static function crearObjeto($registro){
        $objeto = new static; // crea un nuevo objeto en la clase que se esta herendado

        foreach($registro as $key => $value) {
            if (property_exists( $objeto, $key)) { //esta funcion compara el objeto con la key,y verifica si efectivamente hay una relacion
                $objeto->$key = $value;
            }
        }
        return $objeto;
    }

    // Sincronizar el objeto en memoria con los cambios realizados por el usuario
    public function sincronizar( $args = []){
        foreach ($args as $key => $value) {
            if (property_exists($this, $key) && !is_null($value)) {
                $this->$key = $value; //asigna el nuevo valor
            }
        }
    }
    
}