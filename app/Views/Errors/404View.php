<?php ob_start(); 

$titre = "Error 404, page not found";
$content = ob_get_clean();
require_once "../app/Views/layouts/templateView.php";