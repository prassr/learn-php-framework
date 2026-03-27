<?php

declare(strict_types=1);


namespace App\Controllers;;

use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Message\ResponseInterface;
# Using factory
use GuzzleHttp\Psr7\HttpFactory;
use Nyholm\Psr7\Factory\Psr17Factory;


class ProductController 
{
    public function index(): ResponseInterface
    {

        $factory = new HttpFactory;
        // for sending body
        $stream = $factory->createStream("List of Products");

        $response = $factory->createResponse();

        $response = $response->withBody($stream);

        return $response;
    }

    public function  show(ServerRequestInterface $request, array $args): ResponseInterface
    {

        $factory = new Psr17Factory;

        /* $id = $request->getQueryParams()["id"]; */
        $id = $args["id"];

        // for sending body
        $stream = $factory->createStream("Single product id $id");

        $response = $factory->createResponse();

        $response = $response->withBody($stream);

    return $response;
}
}