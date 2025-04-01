<?php

use Utils\Autoloader;

require_once "utils/Autoloader.php";
Autoloader::register();

Controllers\HomeController::index();