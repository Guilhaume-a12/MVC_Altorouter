<?php
namespace App\Controllers\Users;

use App\Controllers\CoreController;
use App\Models\Users\UserManager;

class UserController extends CoreController
{

    private $userManager;

    public function __construct()
    {
        PARENT::__construct();
        $this->userManager = new UserManager();
    }

    public function displayLogin()
    {
        require "../app/Views/Users/loginView.php";
    }

    public function login()
    {
        if (!empty($_POST['pseudo']) || !empty($_POST['password'])) {
            $user = $this->userManager->getUserByPseudoDB($_POST['pseudo']);

            if ($user) {
                if (password_verify($_POST['password'], $user->getPassword())) {
                    $_SESSION['connectedUser'] = $user->getPseudo();
                    $_SESSION['role'] = $user->getRole();

                    if (isset($_POST['checkbox'])) {
                        //TODO Create cookie here
                    }
                    $this->alert("success", "Bonjour " . $_SESSION['connectedUser']);
                    header("location:/");
                } else {
                    $this->alert("danger", "Les informations renseignées sont incorrectes.");
                    header("location:login");
                }
            } else {
                $this->alert("danger", "Les informations renseignées sont incorrectes");
                header("location:login");
            }
        } else {
            $this->alert("danger", "Veuillez renseigner votre pseudo et votre mot de passe");
            header("location:login");
        }
    }

    public function logout()
    {
        session_destroy();
        // setcookie('user',"",1);
        header("location:/");
    }

    public function displayRegister()
    {
        require "../app/Views/Users/registerView.php";
    }


    public function register()
    {
        if (!empty($_POST['pseudoIn']) || !empty($_POST['mailIn']) || !empty($_POST['passwordIn']) || !empty($_POST['password2In'])) {
            if ($_POST['passwordIn'] === $_POST['password2In']) {
                $password = password_hash($_POST['passwordIn'], PASSWORD_DEFAULT);
                $result = $this->userManager->addUserDB($_POST['pseudoIn'], $_POST['mailIn'], $password);
                if ($result) {
                    $this->alert("success", "Inscription effectuée");
                    header("location:login");
                } else {
                    throw new \Exception("Une erreur est survenue lors de votre inscription");
                }
            } else {
                $this->alert("danger", "Veuillez confirmer votre mot de passe");
                header("location:register");
            }
        } else {
            $this->alert("danger", "Veuillez remplir tout les champs");
            header("location:register");
        }
    }
}