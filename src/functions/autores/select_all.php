<?php

namespace Functions\Usuarios;

use Exception;
use PDO;

use Database;

class SelectAll
{

    public function __invoke(
        $id_usuarios
    ) {

        try {

            $db = new Database();
            $db = $db->connectDB();

            $sql = "SELECT *
                    FROM autores
                    WHERE deleted = 0";

            $stmt = $db->prepare($sql);

            $stmt->bindParam(':correo', $correo);

            $stmt->execute();

            if ($stmt->rowCount() === 0) {
                return [
                    "error"     => true,
                    "status"    => 404,
                    "body"      => "Usuario no encontrado"
                ];
            }

            $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($usuario["confirmed"] === 0) {
                return [
                    "error"     => true,
                    "status"    => 500,
                    "body"      => "Cuenta sin confirmar"
                ];
            }

            

            return [
                "error"     => false,
                "status"    => 200,
                "body"      => $usuario
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
