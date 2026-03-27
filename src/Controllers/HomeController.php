<?php

declare(strict_types=1);


namespace App\Controllers;;

use Psr\Http\Message\ResponseInterface;
# Using Interface for factory methods type
use Psr\Http\Message\ResponseFactoryInterface;

use Framework\Template\Renderer;

class HomeController 
{
    public function __construct(private ResponseFactoryInterface $factory){}
    public function index(): ResponseInterface
    {
        
        $renderer = new Renderer;

        $contents = $renderer->render("home/index");

        $stream = $this->factory->createStream($contents);

        # create response object using factory.
        $response = $this->factory->createResponse(200); # takes optional argument -> responseCode, deafult is 200

        $response = $response->withBody($stream);

        return $response;
    }
}