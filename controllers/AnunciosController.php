<?php

namespace Controllers;

use Model\Anuncios;
use MVC\Router;

class AnunciosController{

    public static function index( Router $router ){
        if (!$_SESSION) {
            session_start();
        }
        isAuth();
        $anuncios = Anuncios::all();

        //MUESTRA UN MENSAJE CONDICIONAL
        $resultado = $_GET['resultado'] ?? null;

        $router->render('admin/anuncios/index',[
            'anuncios' => $anuncios,
            'resultado' => $resultado
        ]);
    }


    public static function crear( Router $router ){
        
        if (!$_SESSION) {
            session_start();
        }
        isAuth();

        $anuncio = new Anuncios();
        //Arreglo con mensaje de errores
        $errores = Anuncios::getErrores();

        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            //creamos una nueva isntancia del objeto
            $anuncio = new Anuncios($_POST['anuncio']);
            //Validamos los errores
            $errores = $anuncio->validar();

            if(empty($errores)){
                //Guardamos en la base de datos
                $resultado = $anuncio->guardar(null);
                if($resultado){
                    header('Location: /admin/anuncios/index?resultado=1');
                }
            }
        }

        $router->render('admin/anuncios/crear',[
            'anuncio' => $anuncio,
            'errores' => $errores
        ]);
    }


    public static function actualizar( Router $router ){
        isAuth();
        $id = validarORedireccionar('/admin/anuncios/index');
        $anuncio = Anuncios::find($id);
        $errores = Anuncios::getErrores();

        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            //Asignar los atributos
            $args = $_POST['anuncio'];
            $anuncio->sincronizar($args);

            //validacion
            $errores = $anuncio->validar();

            //Revisamos que el arreglo de errores este vacio
            if(empty($errores)){
                $resultado = $anuncio->guardar($anuncio->ID);

                if($resultado){
                    header('Location: /admin/anuncios/index?resultado=2');
                }
            }
        }

        $router->render('admin/anuncios/actualizar',[
            'anuncio' => $anuncio,
            'errores' => $errores
        ]);
    }

    public static function eliminar( ){
        isAuth();
        if($_SERVER['REQUEST_METHOD'] === 'POST'){

            //validamos el ID
            $id = $_POST['id'];
            $id = filter_var($id, FILTER_VALIDATE_INT);

            if($id){
                $tipo = $_POST['tipo'];
                
                if(valiarTipoContenido($tipo)){
                    $anuncio = Anuncios::find($id);
                    $resultado = $anuncio->eliminarLogic();

                    if($resultado){
                        header('Location: /admin/anuncios/index?resultado=3');
                    }
                }
            }
        }
    }

}