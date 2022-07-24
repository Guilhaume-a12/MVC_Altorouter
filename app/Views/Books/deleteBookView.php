<?php ob_start() ?>

<div class="row">
    <div class="col-6">
        <img src="<?=URL?>images/<?=$book->getImage()?>" alt="">
    </div>
    <div class="col-6">
        <p>Titre : <?=$book->getTitle()?></p>
        <p>Pages : <?=$book->getPages()?></p>
    </div>
    <div class="row mt-2">
        <div class="col-6">
            <form action="<?=$this->router->generate('books-delete-validate',["id" => $book->getId()])?>" method="POST" class="">
                <button class="btn btn-danger w-100" name="btnDel">SUPPRIMER</button>
                <input type="hidden" name="token" value="<?=$_SESSION['token']?>">
            </form>
        </div>
        <div class="col-6">
            <a href="<?=$this->router->generate('books')?>" class="btn btn-success d-block">ANNULER</a>
        </div>
    </div>
</div>

<?php
$titre = "Supprimer ".$book->getTitle()." ?";
$content = ob_get_clean();
require_once "../app/Views/layouts/templateView.php";