<?php ob_start(); 

$titre = "Error 403, you have not the necessary permissions";
$content = ob_get_clean();
require_once "../app/Views/layouts/templateView.php";