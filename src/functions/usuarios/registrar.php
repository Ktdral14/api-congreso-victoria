<?php

namespace Functions\Usuarios;

use Database;
use Exception;

class Registrar
{

    public function __invoke(
        $correo,
        $contrasena
    ) {

        try {

            $db = new Database();
            $db = $db->connectDB();

            $sql = "INSERT INTO usuarios (
                        correo,
                        contrasena
                    ) VALUES (
                        :correo,
                        :contrasena
                    )";

            $stmt = $db->prepare($sql);

            $hash = hash("sha256", $contrasena);
            
            $stmt->bindParam(':correo', $correo);
            $stmt->bindParam(':contrasena', $hash);

            $stmt->execute();

            if ($stmt->rowCount() === 0) {
                return [
                    "error" => true,
                    "status" => 500,
                    "body" => "Error al registrar"
                ];
            }

            return [
                "error" => false,
                "status" => 200,
                "body" => $db->lastInsertId()
            ];
        } catch (Exception $error) {
            return [
                "error" => true,
                "status" => 500,
                "body" => $error->getMessage()
            ];
        }
    }
}
