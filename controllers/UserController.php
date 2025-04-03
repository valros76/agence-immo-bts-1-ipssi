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
      $user->initialize(pseudo: $pseudo, password: $password);
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

    $user->initialize(pseudo: $pseudo);
    $userDatas = $user->getByPseudo($pseudo);
    if(!$userDatas){
      throw new Exception("Un problème s'est produit lors de la récupération de vos données.");
    }
    $_SESSION["user_id"] = $userDatas->id;
    $_SESSION["user_pseudo"] = $userDatas->pseudo;
    $_SESSION["user_inscription_date"] = $userDatas->inscription_date;

    header("Location:/user/profile");
    exit;
  }

  public static function profile(){

    if(isset($_SESSION["user_id"])){
      echo $_SESSION["user_id"];
    }

    if(isset($_SESSION["user_pseudo"])){
      echo $_SESSION["user_pseudo"];
    }

    if(isset($_SESSION["user_inscription_date"])){
      echo $_SESSION["user_inscription_date"];
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