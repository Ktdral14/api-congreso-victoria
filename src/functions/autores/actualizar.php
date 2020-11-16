<?php

namespace Functions\Autores;

use Exception;

use Config\Database;

class Actualizar
{

    public function __invoke(
        $id_autores,
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
        } catch (Exception $error) {
            return [
                "error" => true,
                "status" => 500,
                "body" => $error->getMessage()
            ];
        }
    }
}
