<?php

namespace Functions\Proyectos;

use Database;
use Exception;

class Registrar
{

    public function __invoke(
        $id_usuarios,
        $id_categorias,
        $introduccion,
        $objetivos,
        $importancia,
        $alineacion,
        $descripcion,
        $marco,
        $etapas,
        $experiencia,
        $tipificacion,
        $impacto,
        $factibilidad,
        $resultados,
        $url
    ) {

        try {

            $db = new Database();
            $db = $db->connectDB();

            $sql = "INSERT INTO proyectos (
                        id_usuarios,
                        id_categorias,
                        introduccion,
                        objetivos,
                        importancia,
                        alineacion,
                        descripcion,
                        marco,
                        etapas,
                        experiencia,
                        tipificacion,
                        impacto,
                        factibilidad,
                        resultados,
                        url
                    ) VALUES (
                        :id_usuarios,
                        :id_categorias,
                        :introduccion,
                        :objetivos,
                        :importancia,
                        :alineacion,
                        :descripcion,
                        :marco,
                        :etapas,
                        :experiencia,
                        :tipificacion,
                        :impacto,
                        :factibilidad,
                        :resultados,
                        :url
                    )";

            $stmt = $db->prepare($sql);

            $stmt->bindParam(':id_usuarios,', $id_usuarios);
            $stmt->bindParam(':id_categorias,', $id_categorias);
            $stmt->bindParam(':introduccion,', $introduccion);
            $stmt->bindParam(':objetivos,',      $objetivos);
            $stmt->bindParam(':importancia,', $importancia);
            $stmt->bindParam(':alineacion,', $alineacion);
            $stmt->bindParam(':descripcion,', $descripcion);
            $stmt->bindParam(':marco,', $marco);
            $stmt->bindParam(':etapas,', $etapas);
            $stmt->bindParam(':experiencia,', $experiencia);
            $stmt->bindParam(':tipificacion,', $tipificacion);
            $stmt->bindParam(':impacto,', $impacto);
            $stmt->bindParam(':factibilidad,', $factibilidad);
            $stmt->bindParam(':resultados,', $resultados);
            $stmt->bindParam(':url', $url);

            $stmt->execute();

            if ($stmt->rowCount() === 0) {
                return [
                    "error" => true,
                    "status" => 500,
                    "body" => "Error al registar proyecto"
                ];
            }

            return [
                "error" => false,
                "status" => 200,
                "body" => "Proyecto registrado"
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
