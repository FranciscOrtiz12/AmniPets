<?php

namespace Model;

use JetBrains\PhpStorm\Internal\ReturnTypeContract;
use ReflectionFunctionAbstract;

use function PHPSTORM_META\argumentsSet;

class Cont_Home extends ActiveRecord{
    protected static $tabla = "Cont_Home";
    protected $columnasDb = ['slogan_home','nosotros_home','horarioS_home','horarioF_home'];

    public $slogan_home;
    public $nosotros_home;
    public $horarioS_home;
    public $horarioF_home;

    public function __construct( $args = [] )
    {
        $this->slogan_home = $args['slogan_home'] ?? null;
        $this->nosotros_home = $args['nosotros_home'] ?? null;
        $this->horarioS_home = $args['horarioS_home'] ?? null;
        $this->horarioF_home = $args['horarioF_home'] ?? null;
    }

    public function validar(){
        if( $this->slogan_home === "" ){
            self::$errores[] = "El slogan es Obligatorio";
        };

        if( $this->nosotros_home === ""){
            self::$errores[] = 'El Texto "nosotros" es Obligatorio';
        };

        if( $this->horarioS_home === "" ){
            self::$errores[] = 'Debe Ingresar un Horario Semanal';
        };

        if( $this->horarioF_home === "" ){
            self::$errores[] = 'Debe Ingresar un Horario para los Fines de Semana';
        };

        return self::$errores;
    }
}

?>