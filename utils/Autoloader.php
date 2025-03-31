<?php
class Autoloader{

  public static function register(){
    spl_autoload_register(function ($class){
      $class = ucfirst($class);
      if(file_exists("controllers/{$class}.php")){
        require_once "controllers/{$class}.php";
      }
    });
  }

}