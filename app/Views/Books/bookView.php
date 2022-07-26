<?php ob_start() ?>

<div class="row">
    <div class="col-6">
        <img src="<?=URL?>images/<?=$book->getImage()?>" alt="" style="max-width: 500px;">
    </div>
    <div class="col-6">
        <p>Title : <?=$book->getTitle()?></p>
        <p>Pages : <?=$book->getPages()?></p>
    </div>
</div>

<?php
$titre = $book->getTitle();
$content = ob_get_clean();
require_once "../app/Views/layouts/templateView.php";