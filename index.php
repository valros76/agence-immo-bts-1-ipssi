<?php

if(session_status() === PHP_SESSION_NONE){
  session_start();
}

use Exceptions\RouteNotFoundException;
use Utils\Router;
use Utils\Autoloader;

require_once "utils/Autoloader.php";
Autoloader::register();

$router = new Router();
$router->register("/", "Controllers\HomeController::index");
$router->register("/about", "Controllers\AboutController::index");
$router->register("/user/inscription", "Controllers\UserController::inscription");
$router->register("/user/add", "Controllers\UserController::add");
$router->register("/user/connexion", "Controllers\UserController::connexion");
$router->register("/user/connect", "Controllers\UserController::connect");
$router->register("/user/profile", "Controllers\UserController::profile");
$router->register("/user/modify", "Controllers\UserController::update");
$router->register("/user/modify/pseudo", "Controllers\UserController::updatePseudo");
$router->register("/user/disconnect", "Controllers\UserController::disconnect");
$router->register("/user/delete", "Controllers\UserController::delete");

try{
  $router->resolve($_SERVER["REQUEST_URI"]);
}catch(RouteNotFoundException $e){
  echo $e->getMessage();
}