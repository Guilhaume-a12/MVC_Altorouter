<?php

// Login user **************************************
$router->map('GET','/login',[
    "controller" => "App\Controllers\Users\UserController",
    "method" => "displayLogin"
],'login');

$router->map('POST','/login-validate',[
    "controller" => "App\Controllers\Users\UserController",
    "method" => "Login"
],'login-validate');


// Logout user **************************************
$router->map('GET','/logout',[
    "controller" => "App\Controllers\Users\UserController",
    "method" => "logout"
],'logout');


// Register new user **************************************
$router->map('GET','/register',[
    "controller" => "App\Controllers\Users\UserController",
    "method" => "displayRegister"
],'register');

$router->map('POST','/register-validate',[
    "controller" => "App\Controllers\Users\UserController",
    "method" => "register"
],'register-validate');