<?php

use \Slim\Http\Request;
use \Slim\Http\Response;

use Functions\Usuarios\ValidarToken;

$app->get('/usuarios/validar-token', function (Request $request, Response $response) {
    $tk      = $request->getParam('tk');
    
    $validar_token = new ValidarToken();

    $responseBody = $validar_token(
        $tk
    );

    return $response->withJson($responseBody)->withStatus(200);
});
