<?php 

// https://youtu.be/pZTp5NohRfE?list=PLFbnPuoQkKseimWeA4UFo1BPFTeXnv_1S&t=212
// enable strict type checking
declare(strict_types=1);

use GuzzleHttp\Psr7\ServerRequest;
use GuzzleHttp\Psr7\Response;
use GuzzleHttp\Psr7\Utils;
use HttpSoft\Emitter\SapiEmitter;
use League\Route\Router;


ini_set("display_errors", 1);


require dirname(__DIR__) . "/vendor/autoload.php";


$request = ServerRequest::fromGlobals();

$router = new Router;

/* $path = $request->getUri()->getPath(); */

// url path
/* echo $path; */

// page value from the query string
/* $page = $request->getQueryParams()["page"]; */


/* $page = match($path) { */
/*     "/" => "welcome", */
/*     "/products" => "list", */
/*     "/product" => "show", */
/* }; */
/**/

$router->map("GET", "/", "App\Controllers\HomeController::index");

$router->get("/products", function() {

    // for sending body
    $stream = Utils::streamFor("List of Products");

    $response = new Response;

    $response = $response->withBody($stream);

    return $response;
});


$router->get("/product/{id:number}", function($request, $args) {

    /* $id = $request->getQueryParams()["id"]; */
    $id = $args["id"];

    // for sending body
    $stream = Utils::streamFor("Single product id $id");

    $response = new Response;

    $response = $response->withBody($stream);

    return $response;
});



/* echo $page; */

$response = $router->dispatch($request);

$emitter = new SapiEmitter;

$emitter->emit($response);

?>
