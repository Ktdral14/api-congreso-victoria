<?php

use \Slim\Http\Request;
use \Slim\Http\Response;

use Functions\Usuarios\GenerarToken;

$app->put('/usuarios/generar-token', function (Request $request, Response $response) {
    $correo   = $request->getParam('correo');

    $generar = new GenerarToken();

    $responseBody = $generar(
        $correo
    );

    return $response->withJson($responseBody)->withStatus(200);
});
