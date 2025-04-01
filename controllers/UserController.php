<?php
namespace Controllers;

use Utils\View;

class UserController{

  public static function inscription(){
    View::load("inscription");
  }

  public function add(){
    /**
     * TODO : Add user into BDD
     */
  }

  public static function connexion(){
    View::load("connexion");
  }

  public static function connect(){
    View::load("profile");
  }

}