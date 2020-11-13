<?php

use Functions\Autores\Eliminar;
use \Slim\Http\Request;
use \Slim\Http\Response;

use \Functions\Autores\Registrar as NuevoAutor;
use \Functions\Usuarios\Registrar;
use \Functions\Usuarios\GenerarToken;
use \Functions\Usuarios\EnviarCorreoConfirmarCuenta;

$app->post('/usuarios/registrar', function (Request $request, Response $response) {
    $nombres            = $request->getParam('nombres');
    $a_paterno          = $request->getParam('a_paterno');
    $a_materno          = $request->getParam('a_materno');
    $sexo               = $request->getParam('sexo');
    $fecha_nacimiento   = $request->getParam('fecha_nacimiento');
    $estado             = $request->getParam('estado');
    $ciudad             = $request->getParam('ciudad');
    $colonia            = $request->getParam('colonia');
    $calle              = $request->getParam('calle');
    $num_int            = $request->getParam('num_int');
    $num_ext            = $request->getParam('num_ext');
    $correo             = $request->getParam('correo');
    $contrasena            = $request->getParam('contrasena');
    
    $nuevoAutor = new NuevoAutor();
    
    $autor = $nuevoAutor(
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
    );
    
    if ((int)$autor["body"] === 0) {
        return $response->withJson($autor)->withStatus(200);
    }
    
    $id_autores = $autor["body"];
    
    $registrar = new Registrar();

    $generar = new GenerarToken();

    $enviarCorreo = new EnviarCorreoConfirmarCuenta();

    
    $responseBody = $registrar(
        $id_autores,
        $correo,
        $contrasena
    );

    if ($responseBody["error"]) {

        $eliminar = new Eliminar();

        $secondaryResponse = $eliminar($id_autores);

        if ($secondaryResponse["error"]) {
            return $response->withJson($secondaryResponse)->withStatus(200);
        }

        return $response->withJson($responseBody)->withStatus(200);
    }

    $responseBody = $generar(
        $correo
    );

    if ($responseBody["error"]) {
        return $response->withJson($responseBody)->withStatus(200);
    }

    $responseBody = $enviarCorreo(
        $responseBody["body"],
        $correo
    );
    return $response->withJson($responseBody)->withStatus(200);
});
