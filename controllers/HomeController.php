<?php

namespace Controllers;

use Utils\View;

class HomeController{

  public static function index(){
    View::load("home");
  }

}