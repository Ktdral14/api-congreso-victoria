<?php

namespace Functions\Usuarios;

use Exception;

use Mail;

class EnviarCorreoConfirmarCuenta
{
    const ASUNTO = "Confirmacion de correo Congreso Victoria";

    public function __invoke(
        $tk,
        $correo
    ) {
        try {
            $mail = Mail::configureMail();
            
            $body = new CuerpoConfirmarCuenta($tk);
            $body = $body->GetBody();

            $mail->addAddress($correo);

            $mail->Subject = $this::ASUNTO;
            $mail->Body = $body;
            $sended = $mail->send();

            if (!$sended) {
                return [
                    "error"     => true,
                    "status"    => 500,
                    "body"      => "Error al enviar el correo"
                ];
            }

            return [
                "error"     => false,
                "status"    => 200,
                "body"      => "Correo de confrimación enviado"
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
