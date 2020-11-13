<?php

use \Slim\Http\Request;
use \Slim\Http\Response;

use \Functions\Usuarios\CambiarContrasena;

$app->get('/usuarios/cambiar-contrasena', function (Request $request, Response $response) {
    $tk                 = $request->getParam('tk');
    $nueva_contrasena   = $request->getParam('nueva_contrasena');

    $cambiar_contrasena = new CambiarContrasena();

    $responseBody = $cambiar_contrasena(
        $tk,
        $nueva_contrasena
    );

    return $response->withJson($responseBody)->withStatus(200);
});
