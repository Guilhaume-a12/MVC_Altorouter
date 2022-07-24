<?php ob_start() ?>

<div class="row">
    <div class="col-6">
        <img src="<?=URL?>images/<?=$book->getImage()?>" alt="">
    </div>
    <div class="col-6">
        <p>Titre : <?=$book->getTitle()?></p>
        <p>Pages : <?=$book->getPages()?></p>
    </div>
</div>

<?php
$titre = $book->getTitle();
$content = ob_get_clean();
require_once "../app/Views/layouts/templateView.php";