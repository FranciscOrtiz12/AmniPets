<?php

namespace Model;

class Medicos extends ActiveRecord{
    protected static $tabla = "MEDICOS";
    protected static $primaryKey = 'ID';
    protected static $columnasDb = ['ID','NOMBRE_MED','APELLIDO_MED','ESPECIALIDAD_MED','FOTO','ELIMINADO'];
    public static $carpetaSec = "medicos/";

    public $ID;
    public $NOMBRE_MED;
    public $APELLIDO_MED;
    public $ESPECIALIDAD_MED;
    public $FOTO;
    public $ELIMINADO;

    public function __construct( $args = [] )
    {
        // ?? = en caso de que noe ste titulo sera un string vacio
        $this->ID = $args['ID'] ?? null; 
        $this->NOMBRE_MED = $args['NOMBRE_MED'] ?? null; 
        $this->APELLIDO_MED = $args['APELLIDO_MED'] ?? null; 
        $this->ESPECIALIDAD_MED = $args['ESPECIALIDAD_MED'] ?? null; 
        $this->FOTO = $args['FOTO'] ?? "";
        $this->ELIMINADO = $args['ELIMINADO'] ?? 0; 

    }

    public function validar(){
        if($this->NOMBRE_MED === ""){
            self::$errores[] = "El Nombre es Obligatorio";
        };

        if($this->APELLIDO_MED === ""){
            self::$errores[] = "El Apellido es Obligatorio";
        };

        if($this->ESPECIALIDAD_MED === ""){
            self::$errores[] = "La Especialidad es Obligatoria";
        };

        if($this->FOTO === ""){
            self::$errores[] = "La Especialidad es Obligatoria";
        };

        return self::$errores;
    }
}