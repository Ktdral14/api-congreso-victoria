<?php

namespace Functions\Usuarios;

use Database;
use Exception;

class GenerarToken
{

    public function __invoke(
        $correo
    ) {

        $tk = openssl_random_pseudo_bytes(16);
        $tk = bin2hex($tk);

        try {

            $db = new Database();
            $db = $db->connectDB();

            $sql = "UPDATE usuarios SET
                        tk = :tk
                    WHERE
                        correo = :correo";

            $stmt = $db->prepare($sql);

            $stmt->bindParam(':correo', $correo);
            $stmt->bindParam(':tk', $tk);

            $stmt->execute();

            if ($stmt->rowCount() == 0 && $stmt) {
                return [
                    "error"     => true,
                    "status"    => 500,
                    "body"      => "Error al generar token"
                ];
            }

            return [
                "error"     => false,
                "status"    => 200,
                "body"      => $tk
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
