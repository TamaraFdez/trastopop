<?php

namespace App\Controllers;

class ErrorController
{
    /**
     * Error 404 no encontrado
     * @param string $message
     * @return void
     */
    static function notFount($message = "La página a la que intentas acceder no existe.")
    {
        http_response_code(404);
        loadView('error', [
            'status' => '404',
            'message' => $message
        ]);
    }

    /**
     * Error 403 no autorizado
     * @param string $message
     * @return void
     */
    static function unauthorized($message = "No tienes permisos")
    {
        http_response_code(403);
        loadView('error', [
            'status' => '404',
            'message' => $message
        ]);
    }
}
