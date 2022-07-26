<?php ob_start() ?>

<form action="<?=$this->router->generate('register-validate')?>" method="POST">
    <div class="mb-3">
        <label for="pseudo" class="form-label">Pseudo</label>
        <input type="text" class="form-control" id="pseudo" name="pseudoIn">
    </div>
    <div class="mb-3">
        <label for="mail" class="form-label">Mail</label>
        <input type="text" class="form-control" id="mail" name="mailIn">
    </div>
    <div class="mb-3">
        <label for="password" class="form-label">Password</label>
        <input type="password" class="form-control" id="password" name="passwordIn">
    </div> 
    <div class="mb-3">
        <label for="password2" class="form-label">Confirm password</label>
        <input type="password" class="form-control" id="password2" name="password2In">
    </div> 
    <button type="submit" class="btn btn-primary">Register</button>
</form>

<?php
$titre = "Registration page";
$content = ob_get_clean();
require_once "../app/Views/layouts/templateView.php";