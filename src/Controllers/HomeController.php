<?php

declare(strict_types=1);


namespace App\Controllers;;

use Psr\Http\Message\ResponseInterface;
# Using factory
use GuzzleHttp\Psr7\HttpFactory;
use Nyholm\Psr7\Factory\Psr17Factory;

class HomeController 
{
    public function __construct(private Psr17Factory $factory){}
    public function index(): ResponseInterface
    {
        
        $stream = $this->factory->createStream("Welcome to the homepage");

        # create response object using factory.
        $response = $this->factory->createResponse(200); # takes optional argument -> responseCode, deafult is 200

        $response = $response->withBody($stream);

        return $response;
    }
}