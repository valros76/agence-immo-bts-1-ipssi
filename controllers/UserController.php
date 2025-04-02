<?php
namespace Controllers;

use Exception;
use Utils\BDD;
use Utils\View;
use Models\User;

class UserController{

  public static function inscription(){
    View::load("inscription");
  }

  public static function add(){
    $user = new User(BDD::connect());
    $pseudo = isset($_POST["pseudo"]) ? $_POST["pseudo"] : null;
    $password = isset($_POST["password"]) ? $_POST["password"] : null; 

    if (!$pseudo || !$password) {
      header("Location:/user/inscription");
      exit;
    };

    try{
      $user->initialize($pseudo, $password);
      $pseudo = null;
      $password = null;
  
      if(!$user->add()){
        header("Location:/user/inscription");
        exit;
      }
  
      header("Location:/user/connexion");
      exit;
    }catch(Exception $e){
      header("Location:/user/inscription");
      exit;
    }
  }

  public static function connexion(){
    View::load("connexion");
  }

  public static function connect(){
    header("Location:/user/profile");
    exit;
  }

  public static function profile(){
    View::load("profile");
  }

}