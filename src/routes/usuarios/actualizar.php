<?php

use \Slim\Http\Request;
use \Slim\Http\Response;

use Functions\Usuarios\Actualizar;

$app->put('/usuarios/actualizar', function (Request $request, Response $response) {
    $id_usuarios        = $request->getParam('id_usuarios');
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

    $actualizar = new Actualizar();

    $responseBody = $actualizar(
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
    );

    return $response->withJson($responseBody)->withStatus(200);
});
