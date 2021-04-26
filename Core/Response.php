<?php

/**
 * User: Mamadou Sarr
 * Date: 25/12/2020
 *Time: 21:36
 */

namespace App\Core;

class Response
{
    public function setStatusCode(int $code): void
    {
        http_response_code($code);
    }

    public function redirect(string $url): void
    {
        header('Location: ' . $url);
    }
}
