<?php

namespace App\Controllers;

use App\Controllers\ErrorController;
use Exception;

abstract class CoreController
{
    public $router;

    public function __construct()
    {
        global $router;
        $this->router = $router;

        global $match;

        $routeName = $match['name'];

        $acl = [
            // HOME
            "home" => ["admin","user","login"],

            // USER
            "login" => ["connected","login"],
            "login-validate" => ['connected',"login"],
            "register" => ["connected","login"],
            "register-validate" => ['connected',"login"],

            // BOOKS
            "books" => ["admin", "user"],
            "books-read" => ["admin", "user"],
            "books-add" => ["admin"],
            "books-add-validate" => ["admin"],
            "books-update" => ["admin"],
            "books-update-validate" => ["admin"],
            "books-delete" => ["admin"],
            "books-delete-validate" => ["admin"],
        ];

        if (array_key_exists($routeName, $acl)) {
            $autorizedRoles = $acl[$routeName];

            $this->checkAuthorization($autorizedRoles);
        }

        $csrfTokenToCreate = [
            "books-add",
            "books-update",
            "books-delete",
        ];
        if (in_array($routeName, $csrfTokenToCreate)) {

            $_SESSION['token'] = bin2hex(random_bytes(32));
        }

        $csrfTokenToCheck = [
            "books-add-validate",
            "books-update-validate",
            "books-delete-validate"
        ];

        if (in_array($routeName, $csrfTokenToCheck)) {
            if (isset($_GET['token'])) {
                $token = $_GET['token'];
            } else if (isset($_POST['token'])) {
                $token = $_POST['token'];
            } else {
                $token = null;
            }
            $sessionToken = isset($_SESSION['token']) ? $_SESSION['token'] : null;

            if ($token != $sessionToken || empty($token)) {
                $errorController = new ErrorController();
                $errorController->error403();
                exit;
            } else {
                unset($_SESSION['token']);
            }
        }
    }


    protected function checkAuthorization(array $roles = [])
    {

        if (isset($_SESSION['connectedUser'])) {
            if (in_array('connected', $roles)) {
                $this->alert("danger", "You're already connected");
                header("location:" . $this->router->generate('home'));
                exit;
            }

            $userRole = $_SESSION['role'];
            if (in_array($userRole, $roles)) {

                return true;
            } else {
                $errorController = new ErrorController();

                $errorController->error403();
                exit;
            }
        } else if (in_array("login",$roles) && !isset($_SESSION['connectedUser'])) {
            return true;
        } else {
            $this->alert("danger","You must log in");
            header('Location: ' . $this->router->generate('login'));
            exit;
        }
    }

    protected function addImage($title, $file, $dir)
    {
        try {
            if (!isset($file['name']) || empty($file['name']))
                throw new Exception("You must select an image");


            $extension = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));

            $random = rand(0, 99999);

            $file['name'] = str_replace(" ", "_", $title . "." . $extension);

            $target_file = $dir . $random . "_" . $file['name'];


            if (!getimagesize($file["tmp_name"]))
                throw new Exception("The selected file is not an image");
            if ($extension !== "jpg" && $extension !== "jpeg" && $extension !== "png" && $extension !== "gif")
                throw new Exception("The file extension is not recognized");
            if (file_exists($target_file))
                throw new Exception("The selected file already exists");
            if ($file['size'] > 1000000)
                throw new Exception("Maximum size exceeded");
            if (!move_uploaded_file($file['tmp_name'], $target_file))
                throw new Exception("Adding the image did not work");
            else return $random . "_" . $file['name'];
        } catch (Exception $e) {
            $this->alert("danger", $e->getMessage());
            header("location:" . $this->router->generate('books-add'));
            exit;
        }
    }

    protected function alert($type, $message)
    {
        $_SESSION['alert'] = [
            "type" => $type,
            "msg" => $message
        ];
        return $_SESSION['alert'];
    }
}
