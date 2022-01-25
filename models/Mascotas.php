<?php

namespace Model;

class Mascotas extends ActiveRecord {
    //Base de datos
    protected static $tabla = 'mascotas';
    protected static $primaryKey = 'ID';
    protected static $columnasDB = ['ID','rutdueño_mas','tipo_mas','tamaño_mas','sexo_mas','vacunas_mas','color_mas','nombre_mas','edad_mas'];

    public $ID;
    public $rutdueño_mas;
    public $tipo_mas;
    public $tamaño_mas;
    public $sexo_mas;
    public $vacunas_mas;
    public $color_mas;
    public $nombre_mas;
    public $edad_mas;

    public function __construct( $args = [] )
    {
        $this->ID = $args['id'] ?? null;
        $this->rutdueño_mas = $args['rutdueño_mas'] ?? '';
        $this->tipo_mas = $args['tipo_mas'] ?? '';
        $this->tamaño_mas = $args['tamaño_mas'] ?? null;
        $this->sexo_mas = $args['sexo_mas'] ?? '';
        $this->vacunas_mas = $args['vacunas_mas'] ?? '';
        $this->color_mas = $args['color_mas'] ?? '';
        $this->nombre_mas = $args['nombre_mas'] ?? null;
        $this->edad_mas = $args['edad_mas'] ?? '';
    }

    public static function where( $columna, $valor ) {
        $query = "SELECT * FROM " . self::$tabla  ." WHERE ${columna} = '${valor}'";
        $resultado = self::consultarSQL($query);
        return $resultado;
    }

    public static function consultarIdNombre( $rut ){
        $query = "SELECT ID, nombre_mas FROM " . self::$tabla  ." WHERE rutdueño_mas = '${rut}'";
        $resultado = self::consultarSQL($query);
        return $resultado;
    }
}
