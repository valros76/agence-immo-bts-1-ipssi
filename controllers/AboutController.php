<?php
namespace Controllers;

use Utils\View;

class AboutController{

  public static function index(){
    View::load("about");
  }
  
}