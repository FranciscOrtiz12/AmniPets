<?php

namespace Model;

class Anuncios extends ActiveRecord{
    protected static $tabla = "ANUNCIOS_WE";
    protected static $primaryKey = "ID";
    protected static $columnasDb = ['ID','TITULO_ANUN','TEXTO_ANUN','CREADO_ANUN','ELIMINADO'];

    public $ID;
    public $TITULO_ANUN;
    public $TEXTO_ANUN;
    public $CREADO_ANUN;
    public $ELIMINADO;

    public function __construct($args = [])
    {
        $this->ID = $args['ID'] ?? null;
        $this->TITULO_ANUN = $args['TITULO_ANUN'] ?? null;
        $this->TEXTO_ANUN = $args['TEXTO_ANUN'] ?? null;
        $this->CREADO_ANUN = date('Y,m,d');
        $this->ELIMINADO = $args['ELIMINADO'] ?? 0;
    }

    public function validar(){
        if($this->TITULO_ANUN === ""){
            self::$errores[] = "El Titulo es Obligatorio";
        };
        if($this->TEXTO_ANUN === "" || strlen($this->TEXTO_ANUN) > 200){
            self::$errores[] = "El Titulo es Obligatorio y debe tener 200 caracteres como maximo";
        };
        return self::$errores;
    }

}

?>