<?php

namespace Functions\Usuarios;

use Exception;
use PDO;

use Config\Database;
use \Functions\Autores\SelectAllPerProject;
use \Functions\Propuestas\SelectOne as SelectOnePropuesta;
use \Functions\Proyectos\SelectOne as SelectOneProyectos;

class Login
{
    public function __invoke(
        $correo,
        $contrasena
    ) {
        try {
            $db = new Database();
            $db = $db->connectDB();

            $sql = "SELECT *
                    FROM usuarios
                    WHERE
                        correo = :correo
                    AND deleted = 0";

            $stmt = $db->prepare($sql);

            $stmt->bindParam(':correo', $correo);

            $stmt->execute();

            if ($stmt->rowCount() === 0) {
                return [
                    "error"     => true,
                    "status"    => 404,
                    "body"      => "Usuario no encontrado"
                ];
            }

            $usuario = $stmt->fetch(PDO::FETCH_OBJ);

            if ($usuario->confirmed === 0) {
                return [
                    "error"     => true,
                    "status"    => 500,
                    "body"      => "Cuenta sin confirmar"
                ];
            }

            $hash = hash("sha256", $contrasena);

            if ($usuario->contrasena != $hash) {
                return [
                    "error"     => true,
                    "status"    => 500,
                    "body"      => "Contraseña incorrecta"
                ];
            }

            $getAll = new SelectAllPerProject();

            $autores = $getAll($usuario->id_usuarios);

            if ($autores["error"]) {
                return $autores;
            }

            $usuario->autores = $autores["body"];

            $getOnePropuesta = new SelectOnePropuesta();

            $propuesta = $getOnePropuesta($usuario->id_usuarios);

            $usuario->propuesta = $propuesta["body"];

            $getOneProyectos = new SelectOneProyectos();

            $proyectos = $getOneProyectos($usuario->id_usuarios);

            $usuario->proyectos = $proyectos["body"];

            return [
                "error"     => false,
                "status"    => 200,
                "body"      => $usuario
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
