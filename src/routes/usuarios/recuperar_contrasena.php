<?php

use \Slim\Http\Request;
use \Slim\Http\Response;

use \Functions\Usuarios\EnviarCorreo;
use \Functions\Usuarios\GenerarToken;

$app->put('/usuarios/recuperar-contrasena', function (Request $request, Response $response) {
    $correo   = $request->getParam('correo');

    $generar = new GenerarToken();

    $responseBody = $generar(
        $correo
    );

    if (!$responseBody["error"]) {
        return $response->withJson($responseBody)->withStatus(200);
    }

    $enviarCorreo = new EnviarCorreo();
    $responseBody = $enviarCorreo(
        $responseBody["body"],
        $correo
    );

    return $response->withJson($responseBody)->withStatus(200);
});
