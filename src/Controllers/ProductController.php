<?php

declare(strict_types=1);


namespace App\Controllers;;

use GuzzleHttp\Psr7\ServerRequest;
use GuzzleHttp\Psr7\Response;
use GuzzleHttp\Psr7\Utils;


class ProductController 
{
    public function index(): Response
    {
        // for sending body
        $stream = Utils::streamFor("List of Products");

        $response = new Response;

        $response = $response->withBody($stream);

        return $response;
    }

    public function  show(ServerRequest $request, array $args): Response
    {

    /* $id = $request->getQueryParams()["id"]; */
    $id = $args["id"];

    // for sending body
    $stream = Utils::streamFor("Single product id $id");

    $response = new Response;

    $response = $response->withBody($stream);

    return $response;
}
}