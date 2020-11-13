<?php

use Functions\Usuarios\RecuperarContrasena;
use \Slim\Http\Request;
use \Slim\Http\Response;



$app->get('/usuarios/recuperar-contrasena', function (Request $request, Response $response) {
    $tk      = $request->getParam('tk');
    
    $recuperar_contrasena = new RecuperarContrasena();

    $responseBody = $recuperar_contrasena(
        $tk
    );

    return $response->withJson($responseBody)->withStatus(200);
});
