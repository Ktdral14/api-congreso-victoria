<?php

namespace Functions\Usuarios;

use Exception;

use Config\Mail;

class EnviarCorreoRecuperarContrasena
{
    const ASUNTO = "Recuperación de contraseña Congreso Victoria";

    public function __invoke(
        $tk,
        $correo
    ) {
        try {
            $mail = Mail::configureMail();
            
            $body = new CuerpoCorreoRecuperarContrasena($tk);
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
