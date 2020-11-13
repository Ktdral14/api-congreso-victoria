<?php

namespace Functions\Usuarios;

use Exception;
use Constants;
use PHPMailer\PHPMailer\PHPMailer;

class EnviarCorreo
{
    const ASUNTO = "Recuperación de contraseña Congreso Victoria";

    public function __invoke(
        $tk,
        $correo
    ) {
        try {
            $mail = new PHPMailer();

            $mail->isSMTP();

            $mail->SMTPDebug = 0;
            $mail->SMTPSecure = 'ssl';
            $mail->Host = 'mail.mante.hosting.acm.org';
            $mail->Port = 465;

            $mail->Username = Constants::CORREO;
            $mail->Password = Constants::CONTRASENA;

            $body = file_get_contents("");
            $mail->setFrom(Constants::CORREO, Constants::NOMBRE_REMITENTE);
            $mail->addReplyTo(Constants::CORREO);
            $mail->addAddress($correo);
            $mail->Subject = $this->ASUNTO;;
            $mail->Body = $body;
            $mail->CharSet = "UTF-8";
            $mail->isHTML();

            $sended = $mail->send();

            if (!$sended) {
                return [
                    "error"     => true,
                    "status"    => 500,
                    "body"      => "Error al generar token"
                ];
            }

            return [
                "error"     => false,
                "status"    => 200,
                "body"      => "Correo de recuperación de contraseña enviado"
            ];

        } catch (Exception $error) {
            return [
                "error"     => true,
                "status"    => 500,
                "body"      => $error->getMessage()
            ];
        }
    }
}
