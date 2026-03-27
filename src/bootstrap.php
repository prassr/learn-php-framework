<?php 

// https://youtu.be/pZTp5NohRfE?list=PLFbnPuoQkKseimWeA4UFo1BPFTeXnv_1S&t=212
// enable strict type checking
declare(strict_types=1);

use GuzzleHttp\Psr7\ServerRequest;
use HttpSoft\Emitter\SapiEmitter;
use League\Route\Router;
use App\Controllers\HomeController;
use App\Controllers\ProductController;
use Nyholm\Psr7\Factory\Psr17Factory;



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

$router->map("GET", "/", function(){
    $factory = new Psr17Factory;
    $controller = new HomeController($factory);

    return $controller->index();
}); # laravel style

$router->get("/products", [ProductController::class, "index"]);

$router->get("/product/{id:number}", [ProductController::class, "show"]);

/* echo $page; */

$response = $router->dispatch($request);

$emitter = new SapiEmitter;

$emitter->emit($response);

?>
