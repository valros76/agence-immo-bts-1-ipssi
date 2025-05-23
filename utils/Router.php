<?php
namespace Utils;

use Exceptions\RouteNotFoundException;

class Router{
  private array $routes;

  public function register(string $path, callable $action){
    $this->routes[$path] = $action;
  }

  public function resolve(string $uri){
    $path = explode("?", $uri)[0];
    $action = $this->routes["$path"] ?? null;

    if(!is_callable($action)){
      throw new RouteNotFoundException();
    }

    return $action();
  }
}