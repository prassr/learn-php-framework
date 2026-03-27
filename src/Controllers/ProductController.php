<?php

declare(strict_types=1);


namespace App\Controllers;;

use GuzzleHttp\Psr7\Response;
use GuzzleHttp\Psr7\Utils;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Message\ResponseInterface;


class ProductController 
{
    public function index(): ResponseInterface
    {
        // for sending body
        $stream = Utils::streamFor("List of Products");

        $response = new Response;

        $response = $response->withBody($stream);

        return $response;
    }

    public function  show(ServerRequestInterface $request, array $args): ResponseInterface
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