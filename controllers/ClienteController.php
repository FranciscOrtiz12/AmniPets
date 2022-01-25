<?php

namespace Controllers;

use Model\Mascotas;
use Model\SolicitudControl;
use MVC\Router;

class ClienteController{

    public static function index( Router $router ){

        if (!isset($_SESSION)) {
            session_start();
        }

        isAuth();
    
        $mascotasdelCliente = new Mascotas();
        $mascotasdelCliente = Mascotas::consultarIdNombre( $_SESSION['rut'] );

        $router->render('cliente/cliente', [
            'nombre' => $_SESSION['nombre'],
            'rut' => $_SESSION['rut'],
            'mascotas' => $mascotasdelCliente
        ]);
    }

}