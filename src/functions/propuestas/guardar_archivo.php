<?php

namespace Functions\Propuestas;

use Slim\Http\UploadedFile;

use Constants;

class GuardarArchivo
{

    function __invoke(UploadedFile $uploadedFile, $id_usuarios, $tipo_archivo)
    {
        $extension = pathinfo($uploadedFile->getClientFilename(), PATHINFO_EXTENSION);

        $nombre_archivo = $id_usuarios . $tipo_archivo . "." . $extension;
        $ruta_destino   = Constants::CARPETA_ARCHIVOS_SUBIDOS . $nombre_archivo;

        $uploadedFile->moveTo($ruta_destino);

        return $ruta_destino;
    }
}
