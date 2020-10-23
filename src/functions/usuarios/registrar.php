<?php

namespace Functions\Usuarios;

use Database;
use PDOException;

class Registrar
{

    public function __invoke(
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
                "body" => "Usuario registrado"
            ];

        } catch(PDOException $error) {
            return [
                "error" => true,
                "status" => 500,
                "body" => $error->getMessage()
            ];
        }

    }
}
