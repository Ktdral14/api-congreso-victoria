<?php

namespace Functions\Propuestas;

use Database;
use Exception;

class Registrar
{

    public function __invoke(
        $id_usuarios,
        $nombre_propuesta,
        $p_aspirante,
        $s_aspirante,
        $t_aspirante,
        $carta,
        $c_postulacion,
        $alineacion,
        $propuesta
    ) {

        try {

            $db = new Database();
            $db = $db->connectDB();

            $sql = "INSERT INTO propuestas (
                        id_usuarios,
                        nombre_propuesta,
                        p_aspirante,
                        s_aspirante,
                        t_aspirante,
                        carta,
                        c_postulacion,
                        alineacion,
                        propuesta
                    ) VALUES (
                        :id_usuarios,
                        :nombre_propuesta,
                        :p_aspirante,
                        :s_aspirante,
                        :t_aspirante,
                        :carta,
                        :c_postulacion,
                        :alineacion,
                        :propuesta
                    )";

            $stmt = $db->prepare($sql);

            $stmt->bindParam(':id_usuarios', $id_usuarios);
            $stmt->bindParam(':nombre_propuesta', $nombre_propuesta);
            $stmt->bindParam(':p_aspirante', $p_aspirante);
            $stmt->bindParam(':s_aspirante',      $s_aspirante);
            $stmt->bindParam(':t_aspirante', $t_aspirante);
            $stmt->bindParam(':carta', $carta);
            $stmt->bindParam(':c_postulacion', $c_postulacion);
            $stmt->bindParam(':alineacion', $alineacion);
            $stmt->bindParam(':propuesta', $propuesta);

            $stmt->execute();

            if ($stmt->rowCount() === 0) {
                return [
                    "error" => true,
                    "status" => 500,
                    "body" => "Error al registar propuesta"
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