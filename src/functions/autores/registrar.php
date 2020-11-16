<?php

namespace Functions\Autores;

use Exception;

use Config\Database;

class Registrar
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

            $sql = "INSERT INTO autores (
                        id_usuarios,
                        nombres,
                        a_paterno,
                        a_materno,
                        sexo,
                        fecha_nacimiento,
                        estado,
                        ciudad,
                        colonia,
                        calle,
                        num_int,
                        num_ext
                    ) VALUES (
                        :id_usuarios,
                        :nombres,
                        :a_paterno,
                        :a_materno,
                        :sexo,
                        :fecha_nacimiento,
                        :estado,
                        :ciudad,
                        :colonia,
                        :calle,
                        :num_int,
                        :num_ext
                    )";

            $stmt = $db->prepare($sql);

            $stmt->bindParam(':id_usuarios', $id_usuarios,);
            $stmt->bindParam(':nombres', $nombres,);
            $stmt->bindParam(':a_paterno', $a_paterno,);
            $stmt->bindParam(':a_materno', $a_materno,);
            $stmt->bindParam(':sexo', $sexo,);
            $stmt->bindParam(':fecha_nacimiento', $fecha_nacimiento,);
            $stmt->bindParam(':estado', $estado,);
            $stmt->bindParam(':ciudad', $ciudad,);
            $stmt->bindParam(':colonia', $colonia,);
            $stmt->bindParam(':calle', $calle,);
            $stmt->bindParam(':num_int', $num_int,);
            $stmt->bindParam(':num_ext', $num_ext);

            $stmt->execute();

            if ($stmt->rowCount() === 0) {
                return [
                    "error" => true,
                    "status" => 500,
                    "body" => "Error al registar"
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
