<?php

namespace Functions\Usuarios;

use Exception;

use Mail;

class EnviarCorreo
{
    const ASUNTO = "Recuperación de contraseña Congreso Victoria";

    public function __invoke(
        $tk,
        $correo
    ) {
        try {
            $mail = Mail::configureMail();
            
            $body = file_get_contents("");
            $mail->addAddress($correo);
            $mail->Subject = $this->ASUNTO;;
            $mail->Body = $body;
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
