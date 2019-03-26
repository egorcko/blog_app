<?php

//  Main settings
ini_set('display_errors', 1);
error_reporting(E_ALL);

session_start();

// Files initialize
define('ROOT', dirname(__FILE__));
require_once(ROOT.'/components/Autoload.php');

// Router call
$router = new Router();
$router->run();