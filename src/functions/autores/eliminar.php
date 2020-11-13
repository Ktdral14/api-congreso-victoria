<?php

namespace Functions\Autores;

use Database;
use Exception;

class Eliminar
{

    public function __invoke(
        $id_autores
    ) {

        try {

            $db = new Database();
            $db = $db->connectDB();

            $sql = "UPDATE autores SET
                        deleted = 1
                    WHERE
                        id_autores = :id_autores
                    ";

            $stmt = $db->prepare($sql);

            $stmt->bindParam("id_autores", $id_autores);

            $stmt->execute();

            if ($stmt->rowCount() === 0 && $stmt) {
                return [
                    "error" => false,
                    "status" => 200,
                    "body" => "Error del servidor"
                ];
            }

            return [
                "error" => false,
                "status" => 200,
                "body" => "Autor eliminado"
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
