<?php

namespace Functions\Usuarios;

use Database;
use Exception;
use PDO;

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
                    JOIN autores
                        ON usuarios.id_autores = autores.id_autores
                    WHERE
                        usuarios.correo = :correo";

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

            $hash = hash("sha256", $contrasena);

            if ($usuario->$contrasena != $hash) {
                return [
                    "error"     => true,
                    "status"    => 500,
                    "body"      => "Contraseña incorrecta"
                ];
            }

            return [
                "error"     => true,
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
