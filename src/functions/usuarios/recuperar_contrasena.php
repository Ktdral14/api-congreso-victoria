<?php

namespace Functions\Usuarios;

use Database;
use Exception;

class RecuperarContrasena
{

    public function __invoke(
        $tk
    ) {

        try {

            $db = new Database();
            $db = $db->connectDB();

            $sql = "SELECT * 
                    FROM usuarios
                    WHERE
                        usuarios.tk = :tk";

            $stmt = $db->prepare($sql);

            $stmt->bindParam(':tk', $tk);

            $stmt->execute();

            if ($stmt->rowCount() === 0) {
                return [
                    "error"     => true,
                    "status"    => 500,
                    "body"      => "Token inválido"
                ];
            }

            return [
                "error"     => false,
                "status"    => 200,
                "body"      => "Token válido"
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
