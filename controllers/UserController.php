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

    $user = (object) [
      "id" => isset($_SESSION["user_id"]) ? $_SESSION["user_id"] : null,
      "pseudo" => isset($_SESSION["user_pseudo"]) ? $_SESSION["user_pseudo"] : null,
      "inscription_date" => isset($_SESSION["user_inscription_date"]) ? $_SESSION["user_inscription_date"] : null
    ];  

    $userManager = new User(BDD::connect());

    View::load("profile", params: (object) [
      "user" => $user
    ]);
  }

  public static function update(){
    $user = (object) [
      "id" => isset($_POST["id"]) ? (int) $_POST["id"] : null,
      "pseudo" => isset($_POST["pseudo"]) ? $_POST["pseudo"] : null,
      "password" => isset($_POST["password"]) ? $_POST["password"] : null
    ];

    if(!$user->id || !$user->pseudo || !$user->password){
      $_SESSION["error"] = "Il manque des données pour la mise à jour du profil.";
      header("Location:/user/profile");
      exit;
    }

    $userManager = new User(BDD::connect());
    $userManager->initialize(
      id: $user->id,
      pseudo: $user->pseudo,
      password: $user->password
    );
    $user = null;

    if(!$userManager->update()){
      $_SESSION["error"] = "La mise a jour des données a échoué.";
    }

    $_SESSION["user_pseudo"] = $userManager->getPseudo();
    header("Location:/user/profile");
    exit;
  }

  public static function updatePseudo(){
    $user = (object) [
      "id" => isset($_POST["id"]) ? (int) $_POST["id"] : null,
      "pseudo" => isset($_POST["pseudo"]) ? $_POST["pseudo"] : null
    ];

    if(!$user->id || !$user->pseudo){
      $_SESSION["error"] = "Il manque des données pour la mise à jour du pseudo.";
      header("Location:/user/profile");
      exit;
    }

    $userManager = new User(BDD::connect());
    $userManager->initialize(
      id: $user->id,
      pseudo: $user->pseudo,
    );
    $user = null;

    if(!$userManager->update()){
      $_SESSION["error"] = "La mise a jour du pseudo a échoué.";
    }

    $_SESSION["user_pseudo"] = $userManager->getPseudo();
    header("Location:/user/profile");
    exit;
  }

  public static function disconnect(){
    session_unset();

    header("Location:/user/connexion");
    exit;
  }

  public static function delete(){
    $id = isset($_POST["id"]) ? (int) $_POST["id"] : null;
    
    if(!$id) {
      $_SESSION["error"] = "Votre compte n'a pas pu être authentifié pour la demande de suppression.";
      header("/user/profile");
      exit;
    }

    $userManager = new User(BDD::connect());
    $userManager->initialize(id: $id);

    if(!$userManager->deleteById()){
      $_SESSION["error"] = "La suppression de l'utilisateur a échouée.";
      header("Location:/user/profile");
      exit;
    }

     session_unset();
     header("Location:/user/inscription");
     exit;
  }

}