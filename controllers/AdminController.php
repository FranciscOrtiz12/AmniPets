<?php
namespace Controllers;

use MVC\Router;

class AdminController{
    
    public static function home( Router $router){
        isAuthAmin();

        $router->render("admin/admin",[
            
        ]);
    }
}