<?php ob_start(); 

if (!isset($_SESSION['connectedUser'])) {
?>
<div class="d-flex justify-content-center my-5">
<a class="btn btn-info" href="<?=$this->router->generate('register')?>">Pas encore inscrit ?</a>
</div>
<?php
} else {
?>
<p class="text-center my-5">Vous êtes bien sur la page d'accueil</p>
<?php
}
$titre = "Page d'accueil";
$content = ob_get_clean();
require_once "../app/Views/layouts/templateView.php";