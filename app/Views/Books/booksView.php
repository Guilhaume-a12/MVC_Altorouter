<?php 
ob_start();
?>


<table class="table text-center">
    <tr class="table-dark">
        <th>Image</th>
        <th>Title</th>
        <th>Pages</th>
        <th colspan="2">Actions</th>
    </tr>
    <?php
    foreach($books as $book) {
    ?>
    <tr>
        <td class="align-middle"><img src="<?=URL?>images/<?=$book->getImage()?>" alt="" width="60px;"></td>
        <td class="align-middle"><a href="<?=$this->router->generate('books-read',["id" => $book->getId()])?>"><?= $book->getTitle() ?></a></td>
        <td class="align-middle"><?= $book->getPages() ?></td>
        <td class="align-middle"><a href="<?=$this->router->generate('books-update',["id" => $book->getId()])?>" class="btn btn-warning">Edit</a></td>
        <td class="align-middle"><a class="btn btn-danger" href="<?=$this->router->generate('books-delete',["id" => $book->getId()])?>">Delete</a></td>
    </tr>
    <?php
    }
    ?>
</table>
<a href="<?=$this->router->generate('books-add')?>" class="btn btn-success d-block">Add</a>

<?php

$titre = "List of books";
$content = ob_get_clean();
require_once "../app/Views/layouts/templateView.php";