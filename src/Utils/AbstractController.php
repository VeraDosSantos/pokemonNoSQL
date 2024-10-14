<?php

namespace App\Utils;

abstract class AbstractController
{
    public function redirectToRoute($route)
    {
        http_response_code(303);
        header("Location: {$route} ");
        exit;
    }
}
