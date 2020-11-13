<?php

use \Slim\Http\Request;
use \Slim\Http\Response;

use \Functions\Usuarios\Login;

$app->post('/usuarios/login', function (Request $request, Response $response) {
    $correo     = $request->getParam('correo');
    $contrasena = $request->getParam('contrasena');
    
    $login = new Login();

    $responseBody = $login(
        $correo,
        $contrasena
    );

    return $response->withJson($responseBody)->withStatus(200);
});
