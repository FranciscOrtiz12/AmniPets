<?php

namespace Controllers;

use GuzzleHttp\Psr7\Response;
use Model\Anuncios;
use Model\Blogs;
use Model\Medicos;
use Model\Servicios;
use Model\Contacto;
use MVC\Router;


class PaginasController{
    
    public static function home( Router $router){
        $medicos = Medicos::get(3);
        $anuncios = Anuncios::get(3);
        $blogs = Blogs::get(3);
        $servicios = Servicios::get(4);

        $router->render('paginas/home',[
            'medicos' => $medicos,
            'anuncios' => $anuncios,
            'blogs' => $blogs,
            'servicios' => $servicios

        ]);
    }

    public static function nosotros( Router $router ){  
        $servicios = Servicios::get(4);
        $router->render('paginas/nosotros',[
            'servicios' => $servicios
        ]);
    }

    public static function servicio( Router $router ){
        $id = validarORedireccionar("/");
        $servicio = Servicios::find($id);
        $medico = Medicos::find($servicio->ID_MED);

        $router->render('paginas/servicio',[
            'servicio' => $servicio,
            'medico' => $medico

        ]);
    }

    public static function servicios( Router $router ){
        $servicios = Servicios::all();
        $router->render('paginas/servicios',[
            'servicios' => $servicios
        ]);
    }
    
    public static function blog( Router $router ){
        $id = validarORedireccionar("/");
        $blog = Blogs::find($id);

        $router->render('paginas/blog',[
            'blog' => $blog
        ]);  
    }

    public static function blogs( Router $router ){
        
        $blogs = Blogs::all();
        $router->render('paginas/blogs',[
            'blogs' => $blogs
        ]);   
    }

    public static function anuncio( Router $router ){
        $router->render('paginas/anuncio',[

        ]);   
    }

    public static function anuncios( Router $router ){
        $anuncios = Anuncios::all();

        $router->render('paginas/anuncios',[
            'anuncios' => $anuncios
        ]);  
    }

    public static function contacto( Router $router ){
        $mensaje1 = null;
        $mensaje2 = null;

        $contacto = new Contacto();
        $errores = Contacto::getErrores();

        if( $_SERVER['REQUEST_METHOD'] === 'POST'){
            $DatosContacto = $_POST['contacto'];

            $contacto = new Contacto($DatosContacto);
            //Validamos si no hau errores 
            $errores = $contacto->validar();

            if(empty( $errores )){
                $resultado = $contacto->guardar(null);
                if( $resultado ){
                    $mensaje1 = "Tu solicitud se ha registrado correctamente";
                }
            }

            if( $resultado && $DatosContacto['METODO_CON'] === 'email' ){
                $mensaje2 = enviarMail($DatosContacto['EMAIL_CON'] , $DatosContacto['NOMBRE_CON']);
            }
        }

        $router->render('paginas/contacto',[
            'mensaje1' => $mensaje1,
            'mensaje2' => $mensaje2,
        ]);   
    }

    public static function medicos( Router $router ){
        $medicos = Medicos::all();

        $router->render('paginas/medicos',[
            'medicos' => $medicos
        ]);
    }

    public static function equipo( Router $router ){

        $router->render('paginas/equipo', [

        ]);
    }

}