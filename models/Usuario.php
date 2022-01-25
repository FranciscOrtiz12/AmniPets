<?php

namespace Model;

class Usuario extends ActiveRecord {
    //Base de Datos
    protected static $tabla = 'usuarios_we';
    protected static $primaryKey = 'ID';
    protected static $columnasDb = ['ID','nombre','apellido','rut','email', 'password','telefono','adminn','confirmado','token'];

    public $ID;
    public $nombre;
    public $apellido;
    public $rut;
    public $email;
    public $password;
    public $telefono;
    public $adminn;
    public $confirmado;
    public $token;

    public function __construct( $args = [] ){
        $this->ID = $args['ID'] ?? null;
        $this->nombre = $args['nombre'] ?? '';
        $this->apellido = $args['apellido'] ?? '';
        $this->rut = $args['rut'] ?? '';
        $this->email = $args['email'] ?? '';
        $this->password = $args['password'] ?? '';
        $this->telefono = $args['telefono'] ?? '';
        $this->adminn = $args['adminn'] ?? '0';
        $this->confirmado = $args['confirmado'] ?? '0';
        $this->token = $args['token'] ?? '';
    }

    /* Mensajes de validacion para la creacion de la cuenta */
    public function validarNuevaCuenta(){
        if(!$this->nombre){
            self::$errores['error'][] = "El Nombre es Obligatorio";
        }

        if(!$this->apellido){
            self::$errores['error'][] = "El Apellido es Obligatorio";
        }

        if(!$this->rut){
            self::$errores['error'][] = "El Rut es Obligatorio";
        }elseif(strlen($this->rut) > 10 || strpos( $this->rut, '-' ) === false ){
            self::$errores['error'][] = "El Rut Ingresado no Cumple con los Requisitos";
        }

        if(!$this->email){
            self::$errores['error'][] = "El Email es Obligatorio";
        }

        if(!$this->password){
            self::$errores['error'][] = "El Password es Obligatorio";
        }

        if(strlen($this->password) < 6){
            self::$errores['error'][] = "El password debe contener al menos 6 caracteres";
        }

        return self::$errores;
    }

    public function validarLogin(){
        if(!$this->email){
            self::$errores['error'][] = 'El Email es Obligatorio';
        }
        if(!$this->password){
            self::$errores['error'][] = 'El Password es Obligatorio';
        }

        return self::$errores;
    }

    public function validarEmail(){
        if(!$this->email){
            self::$errores['error'][] = 'El Email es Obligatorio';
        }
        return self::$errores;
    }

    public function validarPassword(){
        
        if(!$this->password){
            self::$errores['error'][] = "El Password es Obligatorio";
        }

        if(strlen($this->password) < 6){
            self::$errores['error'][] = "El password debe contener al menos 6 caracteres";
        }

        return self::$errores;
    }

    public function validarRut(){

        if(!$this->rut){
            self::$errores['error'][] = "El Rut es Obligatorio";
        }

        if(strlen($this->password) > 10 || strpos( $this->rut, '-' ) === false ){
            self::$errores['error'][] = "El Rut Ingresado no Cumple con los Requisitos";
        }

        return self::$errores;
    }

    //Revisa si el usuario ya existe
    public function existeUsuario(){
        $query = " SELECT * FROM " . self::$tabla . " WHERE email = '" . 
        $this->email . "' LIMIT 1";
        $resultado = self::$db->query($query);
        
        if( $resultado->num_rows ){
            self::$errores['error'][] = 'El usuario ya está registrado';
        }
        return $resultado;
    }

    public function hashPassword(){
        $this->password = password_hash( $this->password, PASSWORD_BCRYPT );
    }

    public function crearToken(){
        $this->token = uniqid();
    }

    public function comprobarPasswordAndVerificado($password){
        $resultado = password_verify( $password, $this->password );
        
        if( !$resultado || !$this->confirmado ){
            self::$errores['error'][] = 'Password Incorrecto o tu cuenta no ha sido confirmada';
        }else{
            return true;
        }
    }

}