<?php

namespace App\Controllers;



class ErrorController {

    public $router;

    public function __construct()
    {
        global $router;
        $this->router = $router; 
    }

    public function error404() {
        http_response_code(404);
        require "../app/Views/Errors/404View.php";
    }

    public function error403() {
        http_response_code(403);
        require "../app/Views/Errors/403View.php";
    }
}