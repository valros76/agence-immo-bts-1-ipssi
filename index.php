<?php

use Exceptions\RouteNotFoundException;
use Utils\Router;
use Utils\Autoloader;

require_once "utils/Autoloader.php";
Autoloader::register();

$router = new Router();
$router->register("/", "Controllers\HomeController::index");
$router->register("/about", "Controllers\AboutController::index");

try{
  $router->resolve($_SERVER["REQUEST_URI"]);
}catch(RouteNotFoundException $e){
  echo $e->getMessage();
}