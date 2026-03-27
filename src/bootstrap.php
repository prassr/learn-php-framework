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

# Dependency injection container:
#   A DI container can automatically resolve dependecies when we create an object.
#   Uses PSR-11: Container Interface standard

use DI\Container;


ini_set("display_errors", 1);


require dirname(__DIR__) . "/vendor/autoload.php";


$request = ServerRequest::fromGlobals();

# DI container 
$container = new DI\Container;
# instance of HomeController using DI container
# the container will automatically resolve any dependencies.
$controller = $container->get(HomeController::class);

$router = new Router;


$router->map("GET", "/", function() use ($controller) {
    # here we can directly use the home controller object created using dependency injector.
    return $controller->index();
}); # laravel style

$router->get("/products", [ProductController::class, "index"]);

$router->get("/product/{id:number}", [ProductController::class, "show"]);

/* echo $page; */

$response = $router->dispatch($request);

$emitter = new SapiEmitter;

$emitter->emit($response);

?>
