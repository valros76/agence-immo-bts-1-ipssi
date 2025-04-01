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
        "Exceptions",
        "Models",
        "Utils"
      ];

      foreach($dirs as $dir){
        if(str_contains($class, $dir)){
          $type = lcfirst($dir);
          $class = str_replace("{$dir}/", "", $class);
        }
        if($type && file_exists("{$type}/{$class}.php")){
          require_once "{$type}/{$class}.php";
        }
      }
    });
  }

}