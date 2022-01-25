<?php

namespace Controllers;

use Model\Blogs;
use MVC\Router;
use Intervention\Image\ImageManagerStatic as Image;

class BlogController{
    protected static $carpetaSec = "blogs/";

    public static function index( Router $router ){
        isAuth();
        $blogs = Blogs::all();;

        //MUESTRA UN MENSAJE CONDICIONAL
        $resultado = $_GET['resultado'] ?? null;

        $router->render('/admin/blog/index',[
            'blogs' => $blogs,
            'resultado' => $resultado
        ]);
    }
    
    public static function crear( Router $router ){
        isAuth();
        $blog = new Blogs();
        $errores = Blogs::getErrores();

        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            //Crear nueva instancia
            $blog = new Blogs($_POST['blog']);

            /*********  Subida de Archivos  *********/
            //generar el nombre unico de la imagen
            $nombreImagen = md5( uniqid( rand(), true ) ) . ".jpg";
            
            //SETEAR LA IMAGEN
            //Realiza un resize a la imagen con intervention - class362
            if($_FILES['blog']['tmp_name']['FOTO']){
                $image = Image::make($_FILES['blog']['tmp_name']['FOTO'])->fit(800,600);
                $blog->setImagen(null, $nombreImagen);//Aca le seteamos el nombre de la imagen al active record (osea el objeto en memoria identico a la tabla en la BD)
            }

            //Validamos los errores
            $errores = $blog->validar();
            if(empty($errores)){
                //Crear carpeta para subir imagenes
                if(!is_dir(CARPETA_IMAGENES . self::$carpetaSec)){
                    mkdir(CARPETA_IMAGENES . self::$carpetaSec);
                }

                //Guarda la imagen en el servidor
                if(isset($image)){
                    $image->save(CARPETA_IMAGENES . self::$carpetaSec . $nombreImagen);
                }
                //Guarda la base de datos
                $resultado = $blog->guardar(null);

                if($resultado){
                    //Si se logra crear el blog lo redirecionamos al index
                    header('Location: /admin/blog/index?resultado=1');
                }
            }
        }

        $router->render('/admin/blog/crear',[
            'errores' => $errores,
            'blog' => $blog
        ]);
    }

    public static function actualizar( Router $router ){
        isAuth();
        $id = validarORedireccionar('/admin/blog/index');
        $blog = Blogs::find($id);
        $errores = Blogs::getErrores();

        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            //asignar los atributos
            $args = $_POST['blog'];
            $blog->sincronizar($args);

            //validacion
            $errores = $blog->validar();

            //SUBIDA DE ARCHIVOS
            //Genera el nombre unico de la imagen
            $nombreImagen = md5( uniqid( rand(), true) ) . ".jpg";
            
            //Realiza un resize a la imagen con intervention - class362
            if($_FILES['blog']['tmp_name']['FOTO']){
                $image = Image::make($_FILES['blog']['tmp_name']['FOTO'])->fit(600,600);
                $blog->setImagen($blog->ID,$nombreImagen);
            }

            if(empty($errores)){
                if($_FILES['blog']['tmp_name']['FOTO']){
                    //almacenar la imagen
                    $image->save(CARPETA_IMAGENES . self::$carpetaSec . $nombreImagen);
                }
                
                $resultado = $blog->guardar($blog->ID);

                if($resultado){
                    header('Location: /admin/blog/index?resultado=2');
                }
            }
        }

        $router->render('/admin/blog/actualizar',[
            'blog' => $blog,
            'errores' => $errores
        ]);
    }

    public static function eliminar(){
        isAuth();
        if($_SERVER['REQUEST_METHOD'] === 'POST'){

            //validamos el ID
            $id = $_POST['id'];
            $id = filter_var($id, FILTER_VALIDATE_INT);

            if($id){
                $tipo = $_POST['tipo'];
                if(valiarTipoContenido($tipo)){
                    $blog = Blogs::find($id);
                    $resultado = $blog->eliminarLogic();

                    if($resultado){
                        header('Location: /admin/blog/index?resultado=3');
                    }
                }
            }
        }
    }

}
