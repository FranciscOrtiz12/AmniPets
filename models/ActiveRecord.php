<?php

namespace Model;

use GuzzleHttp\Psr7\Query;

class ActiveRecord{
    //Base de Datos
    protected static $db;
    //Class359
    protected static $tabla = '';
    protected static $primaryKey = '';
    protected static $columnasDb = []; //Esto sirve para poder mapear
    public static $carpetaSec = '';

    //Errores o Validacion
    protected static $errores = [];

    //Definir la conexion a la BD
    public static function setDb($database){
        self::$db = $database;
    }

    public static function setError($tipo, $mensaje){
        static::$errores[$tipo][] = $mensaje;
    }

    //Obtenemos Errores
    public static function getErrores() {
        return static::$errores;
    }

    //Esta funcion identifica si necesitamos guardar un nuevo elemento o actualizar uno existente
    public function guardar($id){
        if (!is_null($id)){ //Si el atributo NO esta como null
            $resultado = $this->actualizar();
        }else{ //Si no hay un id es porque debemos crearlo
            $resultado = $this->crear();
        }
        return $resultado;

    }

    //Creamos nuevos elementos
    public function crear(){
        

        //Sanitizar la entrada de atributos
        $atributos = $this->sanitizarDatos();
        
        //join convierte todas los parametros de un arreglo en una variable. El primer dato que le pasamos es el separador que separara a cada una de las variables, y el segundo se le pasa el arreglo. (en este caso, las llaves del arreglo atributos)

        // Insertar en la base de atributos
        $query = " INSERT INTO ". static::$tabla . " (";
        $query .= join(', ', array_keys($atributos)); //JOIN crea un string en base a un array
        $query .= ")  VALUES ('";
        $query .= join("', '", array_values($atributos)); //en JOIN el primera valor que le pasamos, es el separador que tendran los atributos del array
        $query .= "') "; 

        
        $resultado = self::$db->query($query);
        return $resultado;
    }

    //Actualizamos elementos existentes
    public function actualizar(){

        //Sanitizar la entrada de datos
        $atributos = $this->sanitizarDatos();

        $valores = [];
        foreach($atributos as $key => $value){
            $valores[] = "{$key}='{$value}'";
        }
        
        $query = " UPDATE " . static::$tabla . " SET ";
        $query .= join(', ', $valores); 
        $query .= " WHERE ID = '" . self::$db->escape_string($this->ID) . "' ";
        $query .= " LIMIT 1 ";

        $resultado = self::$db->query($query);
        
        if($resultado){
            return $resultado;
        }
    }

    //Eliminar logico
    public function eliminarLogic(){
        $query = " UPDATE " . static::$tabla . " SET ";
        $query .= "ELIMINADO = 1 WHERE " . static::$primaryKey . " = ";
        $query .= $this->ID . " LIMIT 1";
        
        $resultado = self::$db->query($query);
        if($resultado){
            return $resultado;
        }

    }

    //Eliminar un registro
    public function eliminar($img){
        //ELIMINAR LA PROPIEDAD
        $query = "DELETE FROM " . static::$tabla . " WHERE " . static::$primaryKey . " = " . self::$db->escape_string($this->ID) . " LIMIT 1";
        $resultado = self::$db->query($query); //Almacenamos el resultado en la variable

        if($resultado){
            $this->borrarImagen($img);
            return $resultado;
        }
    }

    //Subida de Archivos a la carpeta en public
    public function setImagen($id,$img){
        //Elimina la imagen previa
        if (!is_null($id)){
            $this->borrarImagen();
        }
    
        if($img){ //si hay una imagen
            // Asignar al atributo de imagen el nombre de la imagen
            $this->FOTO = $img;
        }
    }

    //Elimina el archivo de la carpeta en public
    public function borrarImagen(){
        // Comprobar si existe el archivo
        $existeArchivo = file_exists(CARPETA_IMAGENES . static::$carpetaSec . $this->FOTO);
        if($existeArchivo) {
            unlink(CARPETA_IMAGENES . static::$carpetaSec . $this->FOTO);
        }
    }

    //Atributos desde el post
    public function atributos(){
        $atributos = [];
        foreach(static::$columnasDb as $columna){ // as : En cada iteración, el valor del elemento actual se asigna a $columna
            if($columna === static::$primaryKey) continue; //cuando se cumple esta codicion, el continue deja de ejecutar el codigo y fuerza al foreach a avanzar al siguiente indice 
            $atributos[$columna] = $this->$columna;//aca ya tenemos el objeto creado en memoria, por lo tanto, $this->$columna, ya contiene los datos desde el post
        }
        return $atributos;
    }
    
    //Sanitizar los datos enviados por el usuario (DATOS DEL POST)
    public function sanitizarDatos(){ //class 359
        $atributos = $this->atributos(); //Tomamos el arreglo $atributos desde la function atributos();
        $sanitizado = [];

        foreach($atributos as $key =>$value ){ //esta forma, ademas asigna la clave del elemento actual a la variable $clave en cada iteración. REFERENCIA: //https://www.php.net/manual/es/control-structures.foreach.php
            $sanitizado[$key] = self::$db->escape_string($value);
        }
        return $sanitizado;

    }

    //Validamos is tenemos errores ** ESTA FUNCION ES DISTINTAS SEGUN LA CLASE HIJO **
    public function validar(){
        static::$errores = [];
        return static::$errores;
    }

    //Consultamos a la base de datos por todos los registros
    public static function all(){
        $query = "SELECT * FROM " . static::$tabla;
        $query .= " WHERE ELIMINADO = 0";
        //static llama al atributo $tabla, en la clase en la cual se este heredando

        $resultado = self::consultarSQL($query);

        return $resultado;
    }

    
    //Obtiene determinado numero de registros
    public static function get($cantidad){
        $query = "SELECT * FROM " . static::$tabla . " WHERE ELIMINADO = 0 LIMIT " . $cantidad; //static llama al atributo $tabla, en la clase en la cual se este heredando
        $resultado = self::consultarSQL($query);
        return $resultado;
    }

    //Busca un registro por su ID
    public static function find($id){
        $query = "SELECT * FROM " . static::$tabla . " where " . static::$primaryKey . " = ${id}";
        $resultado = self::consultarSQL($query);

        return array_shift( $resultado ); //array shift toma el primer elemento del arreglo
    }

    public static function where( $columna, $valor ) {
        $query = "SELECT * FROM " . static::$tabla  ." WHERE ${columna} = '${valor}'";
        $resultado = self::consultarSQL($query);
        return array_shift( $resultado ) ;
    }

    public static function consultarSQL($query) {
        // Consultar la base de datos
        $resultado = self::$db->query($query);
        
        // Iterar los resultados
        $array = [];
        while($registro = $resultado->fetch_assoc()) { //mientras que haya un registro en la base de datos se hara lo siguiente y luego procedera a incrementar de valor
            $array[] = static::crearObjeto($registro); //Mandamos a crear un objeto con el $registro(es un array)
        }

        // Liberar la memoria
        $resultado->free();

        // Retornar los resultados
        return $array;
    }

    //Crea un nuevo objeto
    protected static function crearObjeto($registro) {
        $objeto = new static; //new self crea un nuevo objeto de la clase actual Pero new static crea un objeto en la clase heredada

        foreach($registro as $key => $value) { //Este registro contiene un array con las llaves y valores de cada una
            $objeto->$key = $value;
        }  

        return $objeto;
    }
    
    // Sincroniza el objeto en memoria con los cambios realizados por el usuario
    public function sincronizar( $args = [] ) {
        foreach($args as $key => $value){ 
            /* CLASS365 */
            /* $this = hace referencian a todo el objeto actual */
            if(property_exists($this, $key) && !is_null($value)){
                $this->$key = $value;
            }
        }
    }
}