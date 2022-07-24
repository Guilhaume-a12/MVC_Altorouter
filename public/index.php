<?php
session_start();

require "../vendor/autoload.php";

define("URL", str_replace("index.php", "", (isset($_SERVER['HTTPS']) ? " https" : "http") . "://".$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF']));

//active debug mode
$whoops = new \Whoops\Run;
$whoops->pushHandler(new \Whoops\Handler\PrettyPageHandler);
$whoops->register();

//start Altorouter
$router = new AltoRouter();

//Map routes
$router->map('GET','/',[
    "controller" => "App\Controllers\MainController",
    "method" => "home"
],'home');

require_once "maps/usersMap.php";
require_once "maps/booksMap.php";


//Match routes
$match = $router->match();
// var_dump($match);


//dispatch - lie la route avec bon controller/method
$dispatcher = new Dispatcher($match,"App\Controllers\ErrorController::error404");

$dispatcher->dispatch();