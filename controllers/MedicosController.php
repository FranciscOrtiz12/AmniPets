<?php

namespace Controllers;

use MVC\Router;
use Model\Medicos;
use Intervention\Image\ImageManagerStatic as Image;

class MedicosController{
    protected static $carpetaSec = "medicos/";

    public static function index( Router $router ){
        isAuth();
        $medicos = Medicos::all();

        //MUESTRA UN MENSAJE CONDICIONAL
        $resultado = $_GET['resultado'] ?? null ; /* Busca ese valor, y si no existe le asigna un null */

        $router->render('admin/medicos/index',[
            'medicos' => $medicos,
            'resultado' => $resultado
        ]);
    }

    public static function crear( Router $router ){
        isAuth();
        $medico = new Medicos();
        //Arreglo con mensaje de errores
        $errores = Medicos::getErrores();

        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            //Crear una nueva instancia
            $medico = new Medicos($_POST['medico']);
            /*********  Subida de Archivos  *********/
            //generar el nombre unico de la imagen
            $nombreImagen = md5( uniqid( rand(), true ) ) . ".jpg";

            //SETEAR LA IMAGEN
            // Realiza un resize a la imagen con intervention - class362
            if($_FILES['medico']['tmp_name']['FOTO']) {
                $image = Image::make($_FILES['medico']['tmp_name']['FOTO'])->fit(800,600);
                $medico->setImagen(null, $nombreImagen); //Aca le seteamos el nombre de la imagen al active record (osea el objeto en memoria identico a la tabla en la BD)
            }

            //Validamos los errores
            $errores = $medico->validar();

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
                $resultado = $medico->guardar(null);
                if($resultado){
                    //Si se logra crear el medico lo redireccionamos al index
                    header('Location: /admin/medicos/index?resultado=1');
                }
            }
        }

        $router->render('admin/medicos/crear',[
            'errores' => $errores,
            'medico' => $medico
        ]);
    }

    public static function actualizar( Router $router ){
        isAuth();
        $id = validarORedireccionar('/admin');
        $medico = Medicos::find($id);
        $errores = Medicos::getErrores();

        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            //Asignar los Atributos
            $args = $_POST['medico'];
            $medico->sincronizar($args);
        
            //validacion
            
            $errores = $medico->validar();

            //SUBIDA DE ARCHIVOS
            //Genera el nombre unico de la imagen
            $nombreImagen = md5( uniqid( rand(), true ) ) . ".jpg";

            // Realiza un resize a la imagen con intervention - class362
            if($_FILES['medico']['tmp_name']['FOTO']) {
                $image = Image::make($_FILES['medico']['tmp_name']['FOTO'])->fit(800,600);
                $medico->setImagen($medico->ID,$nombreImagen);
            }

            //Revisar que el arreglo de errores este vacio
            if(empty($errores)){
                if($_FILES['medico']['tmp_name']['FOTO']) {
                    // Almacenar la imagen
                    $image->save(CARPETA_IMAGENES . self::$carpetaSec . $nombreImagen);
                }
                // Insertar en la base de datos
                $resultado = $medico->guardar($medico->ID);

                if($resultado){
                    header('Location: /admin/medicos/index?resultado=2');
                }
            }

        }

        $router->render('admin/medicos/actualizar',[
            'errores' => $errores,
            'medico' => $medico
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
                    $medico = Medicos::find($id);
                    $resultado = $medico->eliminarLogic();

                    if($resultado){
                        header('Location: /admin/medicos/index?resultado=3');
                    }
                }
            }
        }
    }
}