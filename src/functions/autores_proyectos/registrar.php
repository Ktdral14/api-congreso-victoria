<?php

namespace Functions\AutoresProjectos;

use Exception;

use Database;

class Registrar
{

    public function __invoke(
        $ids_autores,
        $id_proyectos
    ) {
        try {
            foreach ($ids_autores as $id_autores) {

                $db = new Database();
                $db = $db->connectDB();

                $sql = "INSERT INTO autores_proyectos (
                            id_autores,
                            id_proyectos
                        ) VALUES (
                            :id_autores,
                            :id_proyectos
                        )";

                $stmt = $db->prepare($sql);

                $stmt->bindParam(':id_autores', $id_autores);
                $stmt->bindParam(':id_proyectos', $id_proyectos);

                $stmt->execute();
            }
            return [
                "error"     => false,
                "status"    => 200,
                "body"      => "Exito"
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
