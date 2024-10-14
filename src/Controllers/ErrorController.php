<?php

namespace App\Controllers;


/**
 * on se creer une classe specifique pour gerer les erreurs afin de pouvoir rajouter
 * des methodes differentes en fonction de chaque erreurs.
 */
class ErrorController
{
    static function notFound()
    {
        http_response_code(404);
        require_once(__DIR__ . '/../Views/error/404.php');
        exit();
    }
}
