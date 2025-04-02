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
    $pseudo = isset($_POST["pseudo"]) ? $_POST["pseudo"] : null;
    $password = isset($_POST["password"]) ? $_POST["password"] : null;

    if (!$pseudo || !$password) {
      header("Location:/user/connexion");
      exit;
    }

    $user = new User(BDD::connect());
    if(!$user->verifyLogs($pseudo, $password)){
      header("Location:/user/connexion");
      exit;
    }

    $_SESSION["user_pseudo"] = $pseudo;  

    header("Location:/user/profile");
    exit;
  }

  public static function profile(){

    if(isset($_SESSION["user_pseudo"])){
      echo $_SESSION["user_pseudo"];
    }

    $user = (object) [
      "id" => null,
      "pseudo" => isset($_SESSION["user_pseudo"]) ? $_SESSION["user_pseudo"] : null,
      "inscription_date" => null
    ];

    $userManager = new User(BDD::connect());

    View::load("profile");
  }

}