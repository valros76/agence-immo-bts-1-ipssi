<?php
namespace Utils;

use Exception;
use PDO;

class BDD{
  private static $bdd;

  public static function connect(){
    try{
      $configFile = file_get_contents("/config/config.json");
      $config = json_decode($configFile)->database;
      
      if(!self::$bdd){
        self::$bdd = new PDO("mysql:host={$config->host};dbname={$config->dbname};charset=utf-8;", $config->username, $config->password, [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
      }
  
      return self::$bdd;
    }catch(Exception $e){
      echo "Erreur : {$e->getMessage()}";
    }
  }
}