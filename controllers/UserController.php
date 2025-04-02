<?php
namespace Controllers;

use Utils\BDD;
use Utils\View;
use Models\User;

class UserController{

  public static function inscription(){
    View::load("inscription");
  }

  public static function add(){
    /**
     * TODO : Add user into BDD
     */
    var_dump($_POST);
    $user = new User(BDD::connect());
    var_dump($user);

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