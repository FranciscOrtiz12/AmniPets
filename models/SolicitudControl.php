<?php

namespace Model;

class SolicitudControl extends ActiveRecord {
    //Base de datos
    protected static $tabla = 'solicitudcontrol_we';
    protected static $primaryKey = 'ID';
    protected static $columnasDb = ['ID','rutCl','idMas','fecha','comentario','estado'];

    public $ID;
    public $rutCl;
    public $idMas;
    public $fecha;
    public $comentario;
    public $estado;

    public function __construct( $args = [] )
    {
        $this->ID = $args['ID'] ?? null;
        $this->rutCl = $args['rutCl'] ?? '';
        $this->idMas = $args['idMas'] ?? '';
        $this->fecha = $args['fecha'] ?? '';
        $this->comentario = $args['comentario'] ?? '';
        $this->estado = $args['estado'] ?? 'En Espera';
    }

}