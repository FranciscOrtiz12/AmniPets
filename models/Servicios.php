<?php

namespace Model;

use Attribute;

class Servicios extends ActiveRecord{
    protected static $tabla = "SERVICIOS_WE";
    protected static $primaryKey = "ID";
    protected static $columnasDb = ['ID','NOMBRE_SERV','ID_MED','NOMBRE_MED','APELLIDO_MED','DESCRIPCION_SERV','FOTO','ELIMINADO'];
    public static $carpetaSec = "servicios/";

    public $ID;
    public $NOMBRE_SERV;
    public $ID_MED;
    public $NOMBRE_MED;
    public $APELLIDO_MED;
    public $DESCRIPCION_SERV;
    public $FOTO;
    public $ELIMINADO;

    public function __construct($args = [])
    {
        $this->ID = $args['ID'] ?? null;
        $this->NOMBRE_SERV = $args['NOMBRE_SERV'] ?? null;
        $this->ID_MED = $args['ID_MED'] ?? null;
        $this->NOMBRE_MED = $args['NOMBRE_MED'] ?? null;
        $this->APELLIDO_MED = $args['APELLIDO_MED'] ?? null;
        $this->DESCRIPCION_SERV = $args['DESCRIPCION_SERV'] ?? null;
        $this->FOTO = $args['FOTO'] ?? "";
        $this->ELIMINADO = $args['ELIMINADO'] ?? 0;
    }

    public function validar(){
        if($this->NOMBRE_SERV === "" || strlen($this->NOMBRE_SERV) > 50){
            self::$errores[] = "El Titulo es Obligatorio y debe tener 50 caracteres como maximo";
        };
        if($this->ID_MED === ""){
            self::$errores[] = "Debe Asignar un Medico Para Este Servicio";
        };
        if($this->DESCRIPCION_SERV === "" || strlen($this->DESCRIPCION_SERV) > 5000){
            self::$errores[] = "La descripcion es Obligatoria y debe tener 5000 caracteres como maximo";
        };
        if($this->FOTO === ""){
            self::$errores[] = "La Imagen del Servicio es Obligatoria";
        };

        return self::$errores;
    }

    /* MarceloAlis2365gmail.com
        marceloalis123
    */
    
    public static function all(){
        $query = "SELECT * FROM listadoServicios";
        //static llama al atributo $tabla, en la clase en la cual se este heredando
        $resultado = self::consultarSQL($query);
        return $resultado;
    }

    //Busca un registro por su ID
    public static function find($id){
        $query = "SELECT * FROM " . static::$tabla . " where " . static::$primaryKey . " = ${id}";
        $resultado = self::consultarSQL($query);

        return array_shift( $resultado ); //array shift toma el primer elemento del arreglo
    }

    public function crear(){
        //Sanitizar la entrada de atributos
        $atributos = $this->sanitizarDatos();

        $query = " CALL insertarServicio(" . $atributos['ID_MED'] . ",'" . $atributos['NOMBRE_SERV'] . "','" . $atributos['DESCRIPCION_SERV'] . "','" . $atributos['FOTO'] . "');"; 
        //1 = nombre del servicio
        
        $resultado = self::$db->query($query);
        return $resultado;
    }

    public function actualizar(){
        //Sanitizar la entrada de datos
        $atributos = $this->sanitizarDatos();
        
        $query = " call actualizarServicio(" . $this->ID . "," . $atributos['ID_MED'] . ",'" . $atributos['NOMBRE_SERV'] . "','" . $atributos['DESCRIPCION_SERV'] . "','" . $atributos['FOTO'] ."');";

        $resultado = self::$db->query($query);
        
        if($resultado){
            return $resultado;
        }
    }

}

?>