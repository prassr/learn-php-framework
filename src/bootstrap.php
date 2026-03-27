<?php 

// https://youtu.be/pZTp5NohRfE?list=PLFbnPuoQkKseimWeA4UFo1BPFTeXnv_1S&t=212
// enable strict type checking
declare(strict_types=1);

use GuzzleHttp\Psr7\ServerRequest;
use HttpSoft\Emitter\SapiEmitter;
use League\Route\Router;
use League\Route\Strategy\ApplicationStrategy;
use App\Controllers\HomeController;
use App\Controllers\ProductController;
use GuzzleHttp\Psr7\HttpFactory;
use Nyholm\Psr7\Factory\Psr17Factory;
use Psr\Http\Message\ResponseFactoryInterface;

# Dependency injection container:
#   A DI container can automatically resolve dependecies when we create an object.
#   Uses PSR-11: Container Interface standard

use DI\Container;


ini_set("display_errors", 1);


require dirname(__DIR__) . "/vendor/autoload.php";


$request = ServerRequest::fromGlobals();

# DI container
$container = new DI\Container([
    # single place to configure the class to be used.
    ResponseFactoryInterface::class => DI\create(Psr17Factory::class)
]); # tell the container which specific class to use, when the controller constructor argument type is an interface.

# use the Router to use the container directly

$router = new Router;

$strategy = new ApplicationStrategy;
$strategy->setContainer($container);
# no longer need to create the controller object
# the router will use the container to create the controller object.
# It resolves any dependency the controller has.
$router->setStrategy($strategy);


# with strategy simply specify the handler as the class and method.
$router->map("GET", "/", [HomeController::class, "index"]); # laravel style

$router->get("/products", [ProductController::class, "index"]);

$router->get("/product/{id:number}", [ProductController::class, "show"]);

/* echo $page; */

$response = $router->dispatch($request);

$emitter = new SapiEmitter;

$emitter->emit($response);

?>
