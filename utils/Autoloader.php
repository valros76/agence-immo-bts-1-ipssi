<?php
namespace Utils;
class Autoloader{

  public static function register(){
    spl_autoload_register(function ($class){
      $class = ucfirst($class);
      $class = str_replace("\\", "/", $class);
      $type = null;

      $dirs = [
        "Controllers",
        "Models",
        "Utils"
      ];

      if(file_exists("controllers/{$class}.php")){
        require_once "controllers/{$class}.php";
      }
    });
  }

}