<?php ob_start(); 

if (!isset($_SESSION['connectedUser'])) {
?>
<div class="d-flex justify-content-center my-5">
<a class="btn btn-info" href="<?=$this->router->generate('register')?>">Not registered ?</a>
</div>
<?php
} else {
?>
<p class="text-center my-5">You are on the homepage</p>
<?php
}
$titre = "Home Page";
$content = ob_get_clean();
require_once "../app/Views/layouts/templateView.php";