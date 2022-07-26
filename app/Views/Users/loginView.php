<?php ob_start() ?>

<form action="<?=$this->router->generate('login-validate')?>" method="POST">
    <div class="mb-3">
        <label for="pseudo" class="form-label">Pseudo</label>
        <input type="text" class="form-control" id="pseudo" name="pseudo">
    </div>
    <div class="mb-3">
        <label for="password" class="form-label">Password</label>
        <input type="password" class="form-control" id="password" name="password">
    </div>
    <div class="mb-3 form-check">
        <input type="checkbox" class="form-check-input" id="checkbox" name="checkbox" value="on">
        <label class="form-check-label" for="checkbox">Stay logged in</label>
    </div>
    <button type="submit" class="btn btn-primary">Sign in</button>
</form>

<?php
$titre = "Page de connexion";
$content = ob_get_clean();
require_once "../app/Views/layouts/templateView.php";