<?php

namespace Functions\Usuarios;

use Database;
use PDOException;

class Actualizar
{

    public function __invoke(
        $id_usuarios,
        $nombres,
        $a_paterno,
        $a_materno,
        $sexo,
        $fecha_nacimiento,
        $estado,
        $ciudad,
        $colonia,
        $calle,
        $num_int,
        $num_ext
    ) {

        try {

            $db = new Database();
            $db = $db->connectDB();

            $sql = "";

            $stmt = $db->prepare($sql);

            return [
                "error" => false,
                "status" => 200,
                "body" => "Usuario actualizado"
            ];
        } catch (PDOException $error) {
            return [
                "error" => true,
                "status" => 500,
                "body" => $error->getMessage()
            ];
        }
    }
}
