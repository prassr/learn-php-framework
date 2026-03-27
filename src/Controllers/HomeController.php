<?php

declare(strict_types=1);


namespace App\Controllers;;

# using below interface for psr helps to avoid errors when changing between packages
# which implement this interface.
# Since, we have used this in response type,
# it should not throw any errors when changing the package
# from GuzzleHttp to nyholm/psr7
use Psr\Http\Message\ResponseInterface;
# Using factory
use GuzzleHttp\Psr7\HttpFactory;
use Nyholm\Psr7\Factory\Psr17Factory;

class HomeController 
{
    public function index(): ResponseInterface
    {
        $factory = new Psr17Factory;

        // for sending body
        
        // $stream = Utils::streamFor("Welcome");
        // $stream = Stream::create("Welcome");
        
        // create stream using factory
        $stream = $factory->createStream("Welcome to the homepage");

        # create response object using factory.
        $response = $factory->createResponse(); # takes optional argument -> responseCode, deafult is 200

        $response = $response->withBody($stream);

        return $response;
    }
}