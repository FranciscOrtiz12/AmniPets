<?php
use PHPMailer\PHPMailer\PHPMailer;

define('TEMPLATES_URL', __DIR__ . '/templates');  /* __DIR__ esto toma como referencia el archivo actual para luego */
define('FUNCIONES_URL', __DIR__ . 'funciones.php');
define('CARPETA_IMAGENES',$_SERVER['DOCUMENT_ROOT'] . '/imagenes/'); //DOCUMENT_ROOT NOS DEVUELVE LA RUTA EN LA QUE SE EJECUTA EL PROYECTO, OSEA PUBLIC

function incluirTemplate( string $nombre, bool $inicio = false ){
    include TEMPLATES_URL . "/${nombre}.php";
}

function isAuth() {
    if (!isset($_SESSION)) {
        session_start();
    }

    if(!isset($_SESSION['login'])){
        header('location: /');
    }
}

function isAuthAmin() {
    if (!isset($_SESSION)) {
        session_start();
    }

    if(!isset($_SESSION['login'])){
        header('location: /');
    }elseif($_SESSION['admin'] <> "1"){
        header('location: /');
    }
}

function debuguear($param){
    echo "<pre>";
    var_dump($param);
    echo "</pre>";
    exit;
}

// Escapa / Sanitizar el HTML
function sani($html) : string{
    $s = htmlspecialchars($html);
    return $s;
}

//Validar tipo de contenido a eliminar
function valiarTipoContenido($tipo){
    $tipos = ['medico','anuncio','blog','servicio'];
    return in_array($tipo , $tipos); //Esta funcion busca un string dentro de un arreglo y devuelve un bool -- EL PRIMER ARGUMENTO ES LO QUE SE BUSCARA Y EL SEGUNDO ES EN DONDE LO BUSCARA
}

function mostrarNotificacion($codigo){
    $mensaje = '';

    switch($codigo){
        case 1:
            $mensaje = 'Creado Correctamente';
            break;
        case 2:
            $mensaje = 'Actualizado Correctamente';
            break;
        case 3:
            $mensaje = 'Eliminado Correctamente';
            break;
        default: 
            $mensaje = false;
            break;
    }

    return $mensaje;
}

function validarORedireccionar( string $url){
    // Validar que sea un ID valido
    $id = $_GET['id'];
    $id = filter_var($id, FILTER_VALIDATE_INT); //Validamos si el id es un numero

    if(!$id){ //Si id no es un numero nos redirige al admin
        header("location: ${url}");
    }

    return $id;
}

function enviarMail( $email, $nombre ){
    
    $mail = new PHPMailer();
    $mensaje = "";

    $mail->isSMTP();
    $mail->Host = 'smtp.mailtrap.io';
    $mail->SMTPAuth = true;
    $mail->Port = 2525;
    $mail->Username = '176884d80af054';
    $mail->Password = '342a04ca71db54';

    //Configurar el contenido del mail
    $mail->setFrom('admin@AmniPets.com'); //Quienes lo envian
    $mail->addAddress($email, $nombre); //a quienes se le envia
    $mail->Subject = 'Contacto AmniPets'; //El titulo o asunto

    //Habilitar HTML
    $mail->isHTML(true);
    $mail->CharSet = 'UTF-8';

    //Definir el contenido
    $contenido = '<html>';
    $contenido .= '<h3>Hola ' . $nombre . '</h3>';
    $contenido .= '<p>Hemos recibido tu solicitud con exito. Nos pondremos en contacto contigo a la brevedad.</p>';
    $contenido .= '<h4>Gracias por Preferirnos</h4>';

    $mail->Body = $contenido;
    $mail->AltBody = $contenido;

    if($mail->send()){
        $mensaje = 'Te hemos mandado un correo electronico';
    };
    
    return $mensaje;
}