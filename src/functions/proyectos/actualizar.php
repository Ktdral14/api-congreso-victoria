<?php

namespace Functions\Proyectos;

use Exception;

use Config\Database;

class Actualizar
{

    public function __invoke(
        $id_proyectos,
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

            $sql = "UPDATE proyectos SET
                        id_usuarios = :id_usuarios,
                        id_categorias = :id_categorias,
                        introduccion = :introduccion,
                        objetivos = :objetivos,
                        importancia = :importancia,
                        alineacion = :alineacion,
                        descripcion = :descripcion,
                        marco = :marco,
                        etapas = :etapas,
                        experiencia = :experiencia,
                        tipificacion = :tipificacion,
                        impacto = :impacto,
                        factibilidad = :factibilidad,
                        resultados = :resultados,
                        url = :url
                    WHERE 
                        id_proyectos = $id_proyectos
                    ";

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

            if ($stmt->rowCount() === 0 && $stmt) {
                return [
                    "error" => true,
                    "status" => 500,
                    "body" => "Error al actualizar proyecto"
                ];
            }

            return [
                "error" => false,
                "status" => 200,
                "body" => "Proyecto actualizado"
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
