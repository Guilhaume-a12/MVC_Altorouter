<?php

namespace App\Controllers;

use App\Controllers\CoreController;

class MainController extends CoreController {

    public function home() {
        require "../app/Views/homeView.php";
    }

}