<?php ob_start() ?>

<form action="<?=$this->router->generate('books-update-validate')?>" method="POST" enctype="multipart/form-data">
    <div class="mb-3">
        <label for="title" class="form-label">Title</label>
        <input type="text" class="form-control" id="title" name="title" value="<?=$book->getTitle()?>">
    </div>
    <div class="mb-3">
        <label for="pages" class="form-label">Pages</label>
        <input type="number" class="form-control" id="pages" name="pages" value="<?=$book->getPages()?>">
    </div>
    <div class="mb-3">
        <input type="hidden" class="form-control" name="token" value="<?=$_SESSION['token']?>">
    </div>
    <h3>Image : </h3>
    <img src="<?=URL?>images/<?=$book->getImage()?>" alt="" width="180px">
    <div class="mb-3">
        <label for="image" class="form-label">Select a new image :</label>
        <input class="form-control" type="file" id="image" name="image">
    </div>
    <input type="hidden" name="id" value="<?=$book->getId()?>">
    <button type="submit" class="btn btn-primary">Edit</button>
</form>

<?php
$titre = $book->getTitle()." edit";
$content = ob_get_clean();
require_once "../app/Views/layouts/templateView.php";