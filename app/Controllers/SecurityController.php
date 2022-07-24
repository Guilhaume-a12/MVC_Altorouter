<?php

namespace App\Controllers;

abstract class SecurityController {

    public function __construct()
    {
        global $match;
        
        $routeName = $match['name'];
        
        $acl = [
            // HOME
            "home" => ["admin", "user"],
            
            // BOOKS
            "books"=>["admin","user"],
            "books-read"=>["admin","user"],
            "books-add"=>["admin"],
            "books-add-validate"=>["admin"],
            "books-update"=>["admin"],
            "books-update-validate"=>["admin"],
            "books-delete"=>["admin"],
            "books-delete-validate"=>["admin"],
        ];
        
        if(array_key_exists($routeName,$acl)){
            $autorizedRoles = $acl[$routeName];
    
            $this->checkAuthorization($autorizedRoles);
            
        }

        $csrfTokenToCreate = [
            "books-add",
            "books-update",
            "books-delete",
        ];
        if(in_array($routeName,$csrfTokenToCreate)){

            $_SESSION['token'] = bin2hex(random_bytes(32));
        }

        $csrfTokenToCheck = [
            "books-add-validate",
            "books-update-validate",
            "books-delete-validate"
        ];

        if(in_array($routeName,$csrfTokenToCheck)){
            if(isset($_GET['token'])){
                $token = $_GET['token'];
            }else if(isset($_POST['token'])){
                $token = $_POST['token'];
            }else{
                $token = null;
            }
            $sessionToken = isset($_SESSION['token']) ? $_SESSION['token'] : null;

            if($token != $sessionToken || empty($token)){
                $errorController = new ErrorController();
                $errorController->error403();
                exit;
            }else{
                unset($_SESSION['token']);
            }
            
        }
    }

    protected function checkAuthorization(array $roles=[]){

        if(isset($_SESSION['connectedUser'])){
         
            $userRole = $_SESSION['role'];
            if(in_array($userRole,$roles)){
       
                return true;
            }
            else{
                $errorController = new ErrorController();

                $errorController->error403();
                exit;
            }
        }else{
            global $router;

            header('Location: '.$router->generate('login'));
        }
    }

}