<?php

use \Slim\Http\Request;
use \Slim\Http\Response;

use \Functions\Proyectos\Registrar;

$app->post('/proyectos/registrar', function (Request $request, Response $response) {
    $id_usuarios    = $request->getParam('id_usuarios');
    $id_categorias  = $request->getParam('id_categorias');
    $introduccion   = $request->getParam('introduccion');
    $objetivos      = $request->getParam('objetivos');
    $importancia    = $request->getParam('importancia');
    $alineacion     = $request->getParam('alineacion');
    $descripcion    = $request->getParam('descripcion');
    $identificacion = $request->getParam('identificacion');
    $marco          = $request->getParam('marco');
    $etapas         = $request->getParam('etapas');
    $experiencia    = $request->getParam('experiencia');
    $tipificacion   = $request->getParam('tipificacion');
    $impacto        = $request->getParam('impacto');
    $factibilidad   = $request->getParam('factibilidad');
    $resultados     = $request->getParam('resultados');
    $url            = $request->getParam('url');
    
    $registrar = new Registrar();
    
    $responseBody = $registrar(
        $id_usuarios,
        $id_categorias,
        $introduccion,
        $objetivos,
        $importancia,
        $alineacion,
        $descripcion,
        $identificacion,
        $marco,
        $etapas,
        $experiencia,
        $tipificacion,
        $impacto,
        $factibilidad,
        $resultados,
        $url
    );
    
    return $response->withJson($responseBody)->withStatus(200);
});
