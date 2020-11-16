<?php

namespace Functions\Usuarios;

use Database;
use Exception;

class ConfirmarCuenta
{

    public function __invoke(
        $tk
    ) {

        try {

            $db = new Database();
            $db = $db->connectDB();

            $sql = "UPDATE usuarios SET
                        confirmed = 1,
                        tk = ''
                    WHERE
                        usuarios.tk = :tk";

            $stmt = $db->prepare($sql);

            $stmt->bindParam(':tk', $tk);

            $stmt->execute();

            if ($stmt->rowCount() === 0 && $stmt) {
                return [
                    "error"     => true,
                    "status"    => 500,
                    "body"      => "Error al confirmar"
                ];
            }

            return [
                "error"     => false,
                "status"    => 200,
                "body"      => "Cuenta confirmada"
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
