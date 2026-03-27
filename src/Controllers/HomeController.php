<?php

declare(strict_types=1);


namespace App\Controllers;;

use GuzzleHttp\Psr7\Response;
use GuzzleHttp\Psr7\Utils;
# using below interface for psr helps to avoid errors when changing between packages
# which implement this interface.
# Since, we have used this in response type,
# it should not throw any errors when changing the package
# from GuzzleHttp to nyholm/psr7
use Psr\Http\Message\ResponseInterface;

class HomeController 
{
    public function index(): ResponseInterface
    {
        // for sending body
        $stream = Utils::streamFor("Welcome");

        $response = new Response;

        $response = $response->withBody($stream);

        return $response;
    }
}