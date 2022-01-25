<?php

namespace Controllers;

use Classes\Email;
use Model\Usuario;
use MVC\Router;

class LoginController{

    public static function login(Router $router){
        $alertas = [];
        $auth = new Usuario();

        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            $auth = new Usuario($_POST);
            $alertas = $auth->validarLogin();

            if( empty($alertas) ){
                // Comprobar que el usuario exista
                $usuario = Usuario::where('email', $auth->email );
                if( $usuario ){
                    
                    if( $usuario->comprobarPasswordAndVerificado( $auth->password ) ){
                        // Autenticar al Usuario
                        session_start();
                        $_SESSION['ID'] = $usuario->ID;
                        $_SESSION['nombre'] = $usuario->nombre . " " . $usuario->apellido;
                        $_SESSION['email'] = $usuario->email;
                        $_SESSION['rut'] = $usuario->rut;
                        $_SESSION['login'] = true;
    
                        // Redireccionamiento
                        if( $usuario->adminn === "1" ){
                            $_SESSION['admin'] = $usuario->adminn ?? null;
                            header('Location: /admin');
                        }else{
                            $_SESSION['admin'] = null;
                            header('Location: /cliente');
                        }
                    }
                }else{
                    Usuario::setError('error','Usuario no Encontrado');
                }
            }
        }
        $alertas = Usuario::getErrores();

        $router->render('auth/login',[
            'alertas' => $alertas,
            'auth' => $auth
        ]);
    }

    public static function logout(){
        session_start();
        $_SESSION = [];
        header('Location: /');
    }

    public static function olvide( Router $router ){
        $alertas = [];

        if($_SERVER['REQUEST_METHOD'] === 'POST' ){
            $auth = new Usuario($_POST);
            $alertas = $auth->validarEmail();

            if( empty($alertas) ){
                $usuario = Usuario::where('email', $auth->email);
                
                if( $usuario && $usuario->confirmado === '1'){
                    //Generar un nuevo token
                    $usuario->crearToken();
                    $usuario->guardar($usuario->ID);

                    // Enviar el email
                    $email = new Email( $usuario->nombre, $usuario->email, $usuario->token );
                    $email->enviarInstrucciones();

                    //Alerta de exito
                    Usuario::setError('exito','Revisa tu email');
            
                }else{
                    Usuario::setError('error','El usuario no existe o no esta confirmado');
                }
            }
        }

        $alertas = Usuario::getErrores();

        $router->render('auth/olvide-password', [
            'alertas' => $alertas
        ]);
    }

    public static function recuperar( Router $router ){
        $alertas = [];
        $error = false;

        $token = sani($_GET['token']);
        // Buscar usuario por su token
        $usuario = Usuario::where('token', $token);
        if(empty($usuario)) {
            Usuario::setError('error', 'Token no válido');
            $error = true;
        }

        if( $_SERVER['REQUEST_METHOD'] === 'POST' ){
            // Leer el nuevo password y guardarlo
            $passwordNew = new Usuario($_POST);
            $alertas = $passwordNew->validarPassword();

            if(empty($alertas)){
                $usuario->password = null;

                $usuario->password = $passwordNew->password;
                $usuario->hashPassword();
                $usuario->token = null;

                $resultado = $usuario->guardar($usuario->ID);
                if($resultado){
                    header('Location: /');
                }
            }
        };

        $alertas = Usuario::getErrores();
        $router->render('auth/recuperar-password', [
            'alertas' => $alertas,
            'error' => $error
        ]);
    }

    public static function crear( Router $router ){
        $usuario = new Usuario($_POST);

        //Alertas Vacias
        $alertas = [];

        if( $_SERVER['REQUEST_METHOD'] === 'POST' ){

            $usuario->sincronizar($_POST);
            $alertas = $usuario->validarNuevaCuenta();

            //Revisar que aleta este vacio
            if(empty($alertas)){
                //Verificar si el usuario existe
                $resultado = $usuario->existeUsuario();

                if($resultado->num_rows){
                    $alertas = Usuario::getErrores();

                } else{
                    //Hashear el Password
                    $usuario->hashPassword();
                    //crear un token unico
                    $usuario->crearToken();
                    //Enviar el email
                    $email  = new Email( $usuario->nombre, $usuario->email, $usuario->token );

                    $email->enviarConfirmacion();

                    //Crear el usuario
                    $resultado = $usuario->guardar(null);
                    if($resultado){
                       header('Location: /mensaje');
                    }
                }
            }
        }

        $router->render('auth/crear-cuenta', [
            'usuario' => $usuario,
            'alertas' => $alertas
        ]);
    }

    public static function mensaje( Router $router ){
        $router->render('auth/mensaje');
    }

    public static function confirmar( Router $render ){
        $alertas = [];
        $token = sani($_GET['token']);
        $usuario = Usuario::where('token',$token);
        
        if(empty($usuario)){
            //Mostrar mensaje de error
            Usuario::setError('error','Token No Válido');
        }else{
            //Modificar a usuario confirmado
            $usuario->confirmado = "1";
            $usuario->token = null;
            $usuario->guardar($usuario->ID);
            Usuario::setError('exito','Cuenta Comprobada Correctamente');
        }

        $alertas = Usuario::getErrores();

        //Renderizar la vista
        $render->render('auth/confirmar-cuenta', [
            'alertas' => $alertas
        ]);
    }


}