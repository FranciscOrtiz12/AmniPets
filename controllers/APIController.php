<?php

namespace Controllers;

use Model\Controles;
use Model\Mascotas;
use Model\SolicitudControl;

class APIController {

    /* Obtener Mascotas */
    public static function obtenerMas(){
        $mascotas = Mascotas::where('rutdueño_mas', $_GET['rut']);
        echo json_encode($mascotas);
    }

    public static function obtenerCon(){
        $control = Controles::where('', $_GET['rut']);
        echo json_encode($control);
    }

    public static function solicitarControl(){
        //Almacena la solicitud
        $solicitud = new SolicitudControl($_POST);
        $resultado = $solicitud->crear();

        //Retornamos la respuesta
        echo json_encode(['resultado' => $resultado]);
    }
}