<?php

namespace Model;

use Intervention\Image\Gd\Decoder;

class Blogs extends ActiveRecord{
    protected static $tabla = "BLOGS_WE";
    protected static $primaryKey = "ID";
    protected static $columnasDb = ['ID','TITULO_BLOG','TEXTO_BLOG','CREADO_BLOG','FOTO','ELIMINADO'];
    public static $carpetaSec = "blogs/";

    public $ID;
    public $TITULO_BLOG;
    public $TEXTO_BLOG;
    public $CREADO_BLOG;
    public $FOTO;
    public $ELIMINADO;

    public function __construct($args = [])
    {
        $this->ID = $args['ID'] ?? null;
        $this->TITULO_BLOG = $args['TITULO_BLOG'] ?? null;
        $this->TEXTO_BLOG = $args['TEXTO_BLOG'] ?? null;
        $this->CREADO_BLOG = date('Y,m,d');
        $this->FOTO = $args['FOTO'] ?? "";
        $this->ELIMINADO = $args['ELIMINADO'] ?? 0;
    }

    public function validar(){
        if($this->TITULO_BLOG === ""){
            self::$errores[] = "El Titulo es Obligatorio";
        };

        if($this->TEXTO_BLOG === ""){
            self::$errores[] = "Debe Ingresar un Texto a Mostrar";
        }elseif(strlen($this->TEXTO_BLOG) > 5000){
            self::$errores[] = "El texto supera la cantidad maxima de caracteres";
        }

        if($this->FOTO === ""){
            self::$errores[] = "La Imagen del Blog es Obligatoria";
        }

        debuguear(self::$errores);
        return self::$errores;
    }
}