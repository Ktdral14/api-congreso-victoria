<?php

use PHPMailer\PHPMailer\PHPMailer;

use \Constants;

class Mail
{

    static public function configureMail()
    {
        $mail = new PHPMailer();

        $mail->isSMTP();

        $mail->SMTPSecure = Constants::CERTIFICADO_CORREO;
        $mail->Host = Constants::SERVIDOR_CORREO;
        $mail->Port = Constants::PUERTO_CORREO;

        $mail->Username = Constants::CORREO_SOPORTE;
        $mail->Password = Constants::CONTRASENA_CORREO;
        $mail->setFrom(Constants::CORREO_SOPORTE, Constants::NOMBRE_REMITENTE);
        $mail->addReplyTo(Constants::CORREO_SOPORTE);
        $mail->CharSet = Constants::DEFAULT_CHARSERT;
        $mail->isHTML();

        return $mail;
    }
}
