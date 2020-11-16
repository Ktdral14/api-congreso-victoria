<?php

namespace Functions\Usuarios;

use Database;
use Exception;

class CambiarContrasena
{

    public function __invoke(
        $tk,
        $nueva_contrasena
    ) {

        try {

            $db = new Database();
            $db = $db->connectDB();

            $sql = "UPDATE usuarios SET
                        contrasena = :nueva_contrasena,
                        tk = ''
                    WHERE
                        usuarios.tk = :tk";

            $stmt = $db->prepare($sql);

            $hash = hash("sha256", $nueva_contrasena);

            $stmt->bindParam(':nueva_contrasena', $hash);
            $stmt->bindParam(':tk', $tk);

            $stmt->execute();

            if ($stmt->rowCount() === 0 && $stmt) {
                return [
                    "error"     => true,
                    "status"    => 500,
                    "body"      => "Error al actualizar"
                ];
            }

            return [
                "error"     => false,
                "status"    => 200,
                "body"      => "Contraseña cambiada"
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
