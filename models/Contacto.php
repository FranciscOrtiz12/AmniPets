<?php

namespace Model;

use JetBrains\PhpStorm\Internal\ReturnTypeContract;

class Contacto extends ActiveRecord {
    protected static $tabla = 'CONTACTO_WE';
    protected static $primaryKey = 'ID';
    protected static $columnasDb = ['ID','NOMBRE_CON','ACERCADE_CON','MENSAJE_CON','METODO_CON','EMAIL_CON','TELEFONO_CON','FECHA_CON','CONTACTADO'];
    public static $carpetaSec = "";

    public $ID;
    public $NOMBRE_CON;
    public $ACERCADE_CON;
    public $MENSAJE_CON;
    public $METODO_CON;
    public $EMAIL_CON;
    public $TELEFONO_CON;
    public $FECHA_CON;
    public $CONTACTADO;

    public function __construct( $args = [] )
    {
        $this->ID = $args['ID'] ?? null;
        $this->NOMBRE_CON = $args['NOMBRE_CON'] ?? null;
        $this->ACERCADE_CON = $args['ACERCADE_CON'] ?? null;
        $this->MENSAJE_CON = $args['MENSAJE_CON'] ?? null;
        $this->METODO_CON = $args['METODO_CON'] ?? null;
        $this->EMAIL_CON = $args['EMAIL_CON'] ?? "";
        $this->TELEFONO_CON = $args['TELEFONO_CON'] ?? "";
        $this->FECHA_CON = $args['FECHA_CON'] ?? date('Y,m,d');
        $this->CONTACTADO = $args['CONTACTADO'] ?? 'En Espera';
    }

    public function validar(){
        if( $this->NOMBRE_CON === "" ){
            self::$errores[] = "Debe Ingresar su Nombre";
        }
        if( $this->ACERCADE_CON === "" ){
            self::$errores[] = "Seleccione un tema a consultar";
        }
        if( $this->METODO_CON === "" ){
            self::$errores[] = "Debe ingresar un metodo de contacto";
        }
        if( $this->METODO_CON === "email" && $this->EMAIL_CON === ""){
            self::$errores[] = "Debe ingresar su correo electronico";
        }
        return self::$errores;
    }
}