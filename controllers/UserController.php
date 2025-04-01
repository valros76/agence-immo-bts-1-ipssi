<?php
namespace Controllers;

use Utils\View;

class UserController{

  public static function inscription(){
    View::load("inscription");
  }

  public static function add(){
    /**
     * TODO : Add user into BDD
     */
    var_dump($_POST);
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