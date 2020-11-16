<?php

namespace Functions\Autores;

use Exception;
use PDO;

use Database;

class SelectAllPerProject
{

    public function __invoke(
        $id_usuarios
    ) {

        try {

            $db = new Database();
            $db = $db->connectDB();

            $sql = "SELECT 
                        autores.id_autores as id_autores,
                        autores.nombres as nombres,
                        autores.a_paterno as a_paterno,
                        autores.a_materno as a_materno,
                        autores.sexo as sexo,
                        autores.fecha_nacimiento as fecha_nacimiento,
                        autores.estado as estado,
                        autores.ciudad as ciudad,
                        autores.colonia as colonia,
                        autores.calle as calle,
                        autores.num_int as num_int,
                        autores.num_ext as num_ext
                    FROM autores
                    JOIN usuarios
                        ON autores.id_usuarios = usuarios.id_usuarios
                    WHERE autores.deleted = 0
                        AND autores.id_usuarios = :id_usuarios";

            $stmt = $db->prepare($sql);

            $stmt->bindParam(':id_usuarios', $id_usuarios);

            $stmt->execute();

            if ($stmt->rowCount() === 0) {
                return [
                    "error"     => true,
                    "status"    => 404,
                    "body"      => "Sin autores"
                ];
            }

            return [
                "error"     => false,
                "status"    => 200,
                "body"      => $stmt->fetchAll(PDO::FETCH_ASSOC)
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
