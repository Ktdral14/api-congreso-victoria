<?php

use Functions\Usuarios\Login;
use \Slim\Http\Request;
use \Slim\Http\Response;



$app->get('/usuarios/login', function (Request $request, Response $response) {
    $correo      = $request->getParam('correo');
    $contrasena = $request->getParam('contrasena');
    
    $login = new Login();

    $responseBody = $login(
        $correo,
        $contrasena
    );

    return $response->withJson($responseBody)->withStatus(200);
});
