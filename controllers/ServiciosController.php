<?php
namespace Controllers;

use MVC\Router;
use Model\Blogs;
use Intervention\Image\ImageManagerStatic as Image;
use Model\Medicos;
use Model\Servicios;
use OutOfRangeException;

class ServiciosController{
    protected static $carpetaSec = "servicios/";
    
    public static function index( Router $router ){
        isAuth();
        $servicios = Servicios::all();
        $resultado = $_GET['resultado'] ?? null;

        $router->render("admin/servicios/index",[
            'servicios' => $servicios,
            'resultado' => $resultado
        ]);
    }

    public static function crear( Router $router ){
        isAuth();
        $servicio = new Servicios();
        $medicos = Medicos::all();
        $errores = Servicios::getErrores();

        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            //Creamos una nueva Instacia
            $servicio = new Servicios($_POST['servicio']);

            $nombreImagen = md5( uniqid( rand(), true ) ) . ".jpg";

            //SETEAR LA IMAGEN
            if($_FILES['servicio']['tmp_name']['FOTO']){
                $image = Image::make($_FILES['servicio']['tmp_name']['FOTO'])->fit(800,600);
                $servicio->setImagen(null, $nombreImagen);
            }

            //validamos los errores
            $errores = $servicio->validar();

            if(empty($errores)){
                //Creamos la carpeta para subir imagenes
                
                if(!is_dir(CARPETA_IMAGENES . self::$carpetaSec)){
                    mkdir(CARPETA_IMAGENES . self::$carpetaSec);
                }

                //Guarda la imagen en el servidor
                if(isset($image)){
                $image->save(CARPETA_IMAGENES . self::$carpetaSec . $nombreImagen);
                }
                //Guarda en la base de datos
                $resultado = $servicio->crear();
                if($resultado){
                    //Si se logra crear el servicio, redirecionamos al index con un mensaje
                    header('Location: /admin/servicios/index?resultado=1');
                }
            }
        }

        $router->render("admin/servicios/crear", [
            'servicio' => $servicio,
            'medicos' => $medicos,
            'errores' => $errores
        ]);

    }

    public static function actualizar( Router $router ){
        isAuth();
        $id = validarORedireccionar('/admin');
        $servicio = Servicios::find($id);
        $errores = Servicios::getErrores();
        $medicos = Medicos::all();

        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            $args = $_POST['servicio'];
            $servicio->sincronizar($args);

            //Validacion
            $errores = $servicio->validar();

            //SUBIDA DE ARCHIVOS
            //Genera el nombre unico de la imagen
            $nombreImagen = md5( uniqid( rand(), true ) ) . ".jpg";

            //Realiza un resize a la imagen con intervention - class362
            if($_FILES['servicio']['tmp_name']['FOTO']){
                $image = Image::make($_FILES['servicio']['tmp_name']['FOTO'])->fit(800,600);
                $servicio->setImagen($servicio->ID,$nombreImagen);
            }

            //Revisar que el arreglo de errores este vacio
            if(empty($errores)){
                if($_FILES['servicio']['tmp_name']['FOTO']){
                    //Almacenar la imagen
                    $image->save(CARPETA_IMAGENES . self::$carpetaSec . $nombreImagen);
                }
                //Insertar en la Base de Datos
                $resultado = $servicio->guardar($servicio->ID);

                if($resultado){
                    header('Location: /admin/servicios/index?resultado=2');
                }
            }
        }        

        $router->render('admin/servicios/actualizar', [
            'errores' => $errores,
            'servicio' => $servicio,
            'medicos' => $medicos
        ]);

    }
    public static function eliminar( Router $router ){
        isAuth();
        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            //validar ID
            $id = $_POST['id'];
            $id = filter_var($id, FILTER_VALIDATE_INT);

            if($id){
                $tipo = $_POST['tipo'];
                if(valiarTipoContenido($tipo)){
                    $servicio = Servicios::find($id);
                    $resultado = $servicio->eliminarLogic();

                    if($resultado){
                        header('Location: /admin/servicios/index?resultado=3');
                    }
                }
            }
        }
    }

}