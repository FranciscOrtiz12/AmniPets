<?php

function conectarDB() { //Esto retornara la conexion de mysqli
    //realizamos una conexion
    $db = new mysqli('','','','');// Devolvera un true o un false en caso de que no se conecte //De momento falta la bd que ocuparemos

    if(!$db){ //En caso de que no se conecte
        echo "Error, no se pudo conectar con la Base de Datos";
        exit;
    }
    return $db;
}
