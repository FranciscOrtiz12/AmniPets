<?php

namespace Model;

class Controles extends ActiveRecord {
    //Base de Datos
    protected static $tabla = 'control';
    protected static $primaryKey = 'id_con';
    protected static $columnasDB = ['veterinario','mascota','servicio','fecha','total'];

    public $veterinario;
    public $mascota;
    public $servicio;
    public $fecha;
    public $total;

    public function __construct( $args = [] )
    {
        $this->veterinario = $args['veterinario'] ?? '';
        $this->mascota = $args['mascota'] ?? '';
        $this->servicio = $args['servicio'] ?? '';
        $this->fecha = $args['fecha'] ?? '';
        $this->total = $args['total'] ?? '';
    }

    public static function where( $columna, $valor ){
        $query = "call verControles('${valor}');";
        $resultado = self::consultarSQL($query);
        return $resultado;
    }
}