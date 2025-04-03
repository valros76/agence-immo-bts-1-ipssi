<?php

namespace Utils;

use Exceptions\RouteNotFoundException;

enum Layout: string{
  case DEFAULT = "global_layout.php";
  case USER = "user_layout.php";
  case ADMIN = "admin_layout.php";
}

class View
{

  public static function load(
    string $filename,
    string $ext = "php",
    string $layout = Layout::DEFAULT->value,
    object ...$params
  ) {
    if (!file_exists("views/{$filename}.{$ext}")) {
      throw new RouteNotFoundException();
    }

    foreach($params as $list){
      foreach($list as $var=>$value){
        ${$var} = $value;
      }
    }

    require_once "views/{$filename}.{$ext}";
    require_once self::loadLayout($layout);
  }

  public static function loadLayout(string $layout = Layout::DEFAULT->value)
  {
    switch ($layout) {
      case "admin":
        $layout = Layout::ADMIN->value;
        break;
      case "user":
        $layout = Layout::USER->value;
        break;
      case "default":
      case "global":
      default:
        $layout = Layout::DEFAULT->value;
        break;
    }

    return "layouts/{$layout}";
  }
}
