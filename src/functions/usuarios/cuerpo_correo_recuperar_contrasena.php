<?php

namespace Functions\Usuarios;

use Constants;

class CuerpoCorreoRecuperarContrasena
{
    private $link_cambiar_contrasena = "";

    function __construct($tk)
    {
        $this->link_cambiar_contrasena = Constants::SERVIDOR . Constants::CARPETA_SERVIDOR . 'pagina-recuperar-contrasena/' . $tk;
    }

    public function GetBody()
    {
        return '
            <!DOCTYPE html>
            <html lang="en">
            <head>
                <meta charset="UTF-8">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <title>Confirmar Correo</title>
                <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
            </head>
            <body>
                <div class="container d-flex flex-column justify-content-center mt-5 align-items-center">
                    <div class=" ">
                        <p style="font-size: 30px; "><strong>¿Olvidaste tu contraseña?</strong> </p>
                    </div>
                    <div>
                        <p style="font-size: 20px; ">Entra al siguiente link para reestablecerla.</p>
                    </div>
                    <div>
                        <a href="' . $this->link_cambiar_contrasena . '" class="btn btn-primary ">Recuperar Contraseña</a>
                    </div>
                </div>
                <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
                <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
                <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
            </body>
            </html>
        ';
    }
}
