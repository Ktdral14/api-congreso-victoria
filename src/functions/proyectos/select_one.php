<?php

namespace Functions\Proyectos;

use Exception;
use PDO;

use Config\Database;

class SelectOne
{

    public function __invoke(
        $id_usuarios
    ) {

        try {

            $db = new Database();
            $db = $db->connectDB();

            $sql = "SELECT * 
                    FROM proyectos
                    WHERE id_usuarios = :id_usuarios";

            $stmt = $db->prepare($sql);

            $stmt->bindParam(':id_usuarios', $id_usuarios);

            $stmt->execute();

            if ($stmt->rowCount() === 0) {
                return [
                    "error" => true,
                    "status" => 500,
                    "body" => "No data"
                ];
            }

            return [
                "error" => false,
                "status" => 200,
                "body" => $stmt->fetchColumn(PDO::FETCH_ASSOC)
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