<?php

declare(strict_types=1);


namespace App\Controllers;;

use GuzzleHttp\Psr7\Response;
use GuzzleHttp\Psr7\Utils;

class HomeController 
{
    public function index(): Response
    {
        // for sending body
        $stream = Utils::streamFor("Welcome");

        $response = new Response;

        $response = $response->withBody($stream);

        return $response;
    }
}