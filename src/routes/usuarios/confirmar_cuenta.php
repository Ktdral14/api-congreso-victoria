<?php

use \Slim\Http\Request;
use \Slim\Http\Response;

use \Functions\Usuarios\ConfirmarCuenta;

$app->post('/usuarios/confirmar-cuenta', function (Request $request, Response $response) {
    $tk = $request->getParam('tk');

    $confirmar_cuenta = new ConfirmarCuenta();

    $responseBody = $confirmar_cuenta(
        $tk
    );

    return $response->withJson($responseBody)->withStatus(200);
});
