<?php ob_start() ?>

<form action="<?=$this->router->generate('books-add-validate')?>" method="POST" enctype="multipart/form-data">
    <div class="mb-3">
        <label for="title" class="form-label">Titre</label>
        <input type="text" class="form-control" id="title" name="title">
    </div>
    <div class="mb-3">
        <label for="pages" class="form-label">Nombre de pages</label>
        <input type="number" class="form-control" id="pages" name="pages">
    </div>
    <div class="mb-3">
        <label for="image" class="form-label">Image</label>
        <input class="form-control" type="file" id="image" name="image">
    </div>
    <input type="hidden" name="token" value="<?=$_SESSION['token']?>">
    <button type="submit" class="btn btn-primary">Valider</button>
</form>

<?php
$titre = "Ajout d'un livre";
$content = ob_get_clean();
require_once "../app/Views/layouts/templateView.php";