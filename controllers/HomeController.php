<?php

namespace Controllers;

class HomeController{

  public static function index(){
    require_once "views/home.php";
    require_once "layouts/global_layout.php";
  }

}