<?php ob_start() ?>

<form action="<?=$this->router->generate('books-update-validate')?>" method="POST" enctype="multipart/form-data">
    <div class="mb-3">
        <label for="titre" class="form-label">Titre</label>
        <input type="text" class="form-control" id="titre" name="titre" value="<?=$book->getTitle()?>">
    </div>
    <div class="mb-3">
        <label for="nbPages" class="form-label">Nombre de pages</label>
        <input type="number" class="form-control" id="nbPages" name="nbPages" value="<?=$book->getPages()?>">
    </div>
    <div class="mb-3">
        <input type="hidden" class="form-control" name="token" <?php if (isset($_SESSION['token'])) echo "value='".$_SESSION['token']."'" ?>>
    </div>
    <h3>Image : </h3>
    <img src="<?=URL?>images/<?=$book->getImage()?>" alt="" width="180px">
    <div class="mb-3">
        <label for="image" class="form-label">Changer l'image</label>
        <input class="form-control" type="file" id="image" name="image">
    </div>
    <input type="hidden" name="id" value="<?=$book->getId()?>">
    <button type="submit" class="btn btn-primary">Valider</button>
</form>

<?php
$titre = "Modification du livre : ".$book->getTitle();
$content = ob_get_clean();
require_once "../app/Views/layouts/templateView.php";