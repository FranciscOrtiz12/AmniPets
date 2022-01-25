<?php

namespace Classes;
use PHPMailer\PHPMailer\PHPMailer;

class Email{

    public $email;
    public $nombre;
    public $token;

    public function __construct( $nombre, $email, $token )
    {
        $this->nombre = $nombre;
        $this->email = $email;
        $this->token = $token;
    }

    public function enviarConfirmacion(){
        //Crear el objeto de email
        $mail = new PHPMailer();
        $mail->isSMTP();
        $mail->Host = 'smtp.mailtrap.io';
        $mail->SMTPAuth = true;
        $mail->Port = 2525;
        $mail->Username = '';
        $mail->Password = '';

        $mail->setFrom('cuentas@AmniPets.com');
        $mail->addAddress('cuentas@AmniPets.com', 'AmniPets.com');
        $mail->Subject = 'Confirma tu Cuenta';

        // Set HTML
        $mail->isHTML(TRUE);
        $mail->CharSet = 'UTF-8';

        $contenido = "<html>";
        $contenido .= "<p><strong>Hola " . $this->nombre . "</strong>. Has creado tu cuenta en AmniPets, solo debes confirmarla presionando el siguiente enlace</p>";
        $contenido .= "<p>Presiona aquí <a href='http://localhost:3000/confirmar-cuenta?token=" . $this->token . "'>Confirmar Cuenta</a></p>";
        $contenido .= "<p>Si tu no solicitaste esta cuenta, puedes ignoarar el mensaje</p>";
        $contenido.= "</html>";
        $mail->Body = $contenido;

        //Enviar el mail
        $mail->send();
    }

    public function enviarInstrucciones(){
        //Crear el objeto de email
        $mail = new PHPMailer();
        $mail->isSMTP();
        $mail->Host = 'smtp.mailtrap.io';
        $mail->SMTPAuth = true;
        $mail->Port = 2525;
        $mail->Username = '';
        $mail->Password = '';

        $mail->setFrom('cuentas@AmniPets.com');
        $mail->addAddress('cuentas@AmniPets.com', 'AmniPets.com');
        $mail->Subject = 'Reestablece tu Contraseña';

        // Set HTML
        $mail->isHTML(TRUE);
        $mail->CharSet = 'UTF-8';

        $contenido = "<html>";
        $contenido .= "<p><strong>Hola " . $this->nombre . "</strong>. Has solicitado reestablecer tu password, sigue el siguiente enlace para hacerlo.</p>";
        $contenido .= "<p>Presiona aquí <a href='http://localhost:3000/recuperar?token=" . $this->token . "'>Reestablecer Contraseña</a></p>";
        $contenido .= "<p>Si tu no solicitaste esta cuenta, puedes ignoarar el mensaje</p>";
        $contenido.= "</html>";
        $mail->Body = $contenido;

        //Enviar el mail
        $mail->send();
    }
}
