<?php 

namespace MVC;

class Router{
    public $rutasGET = [];
    public $rutasPOST = [];

    public function get($url, $fn){ //Esta funciuon registrara las rutas GET
        $this->rutasGET[$url] = $fn;
    }

    public function post($url, $fn){ //Esta funciuon registrara las rutas POST
        $this->rutasPOST[$url] = $fn;
    }

    public function comprobarRutas(){

        $urlActual = $_SERVER['PATH_INFO'] ?? '/'; //En caso de que no exista path_info se le asigna /
        $metodo = $_SERVER['REQUEST_METHOD'];

        if($metodo === 'GET'){
            $fn = $this->rutasGET[$urlActual] ?? null; //Esto nos devuelve la funcion asociada a la ruta (el valor de la llave)
        }else{
            $fn = $this->rutasPOST[$urlActual] ?? null;
        }


        if($fn){ //Si existe la funcion
            call_user_func($fn, $this);
        }else{
            $this->render("404" , [], 1);
        }   
    }

    //MUESTRA UNA VISTA
    public function render($view , $datos = [] , $e = 0){

        // e lo utilizamos para poder llamar el login sin importar el header ni footer
        if($e === 1){
            include_once __DIR__ . "/views/$view.php";    
            return;
        }

        foreach($datos as $key => $value){
            $$key = $value; //key mantiene mantiene el nombre del atributo dentro del array
        }
        ob_start(); //Inicia un almacenamiento en memoria

        include __DIR__ . "/views/$view.php";
        $contenido = ob_get_clean(); //todo lo que habiamos almacenado en memoria se le asigna a la variable contenido
        include __DIR__ . "/views/layout.php";
    }
}