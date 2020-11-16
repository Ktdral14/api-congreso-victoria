<?php

use Functions\Propuestas\GuardarArchivo;
use \Slim\Http\Request;
use \Slim\Http\Response;

use \Functions\Propuestas\Registrar;

$app->post('/propuestas/registrar', function (Request $request, Response $response) {
    $id_usuarios        = $request->getParam('id_usuarios');
    $nombre_propuesta	= $request->getParam('nombre_propuesta');
    $p_aspirante        = $request->getParam('p_aspirante');
    $s_aspirante        = $request->getParam('s_aspirante');
    $t_aspirante        = $request->getParam('t_aspirante');

    $archivos_subidos = $request->getUploadedFiles();

    $carta              = $archivos_subidos['carta'];
    $c_postulacion      = $archivos_subidos['c_postulacion'];
    $alineacion         = $archivos_subidos['alineacion'];
    $propuesta          = $archivos_subidos['propuesta'];

    $guardarArchivo = new GuardarArchivo;

    $carta = $guardarArchivo($carta, $id_usuarios, "_carta");
    $c_postulacion = $guardarArchivo($c_postulacion, $id_usuarios, "_c_postulacion");
    $alineacion = $guardarArchivo($alineacion, $id_usuarios, "_alineacion");
    $propuesta = $guardarArchivo($propuesta, $id_usuarios, "_propuesta");
    
    $registrar = new Registrar();
    
    $responseBody = $registrar(
        $id_usuarios,
        $nombre_propuesta,
        $p_aspirante,
        $s_aspirante,
        $t_aspirante,
        $alineacion,
        $carta,
        $c_postulacion,
        $propuesta
    );
    
    return $response->withJson($responseBody)->withStatus(200);
});
