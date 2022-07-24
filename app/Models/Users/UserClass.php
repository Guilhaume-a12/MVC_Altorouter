<?php 
namespace App\Models\Users;

class UserClass {

    public function __construct(
        private int $id,
        private string $pseudo,
        private string $mail,
        private string $password,
        private string $role
    ) {}

    /**
     * Get the value of id
     */ 
    public function getId()
    {
        return htmlspecialchars($this->id);
    }

    /**
     * Get the value of pseudo
     */ 
    public function getPseudo()
    {
        return htmlspecialchars($this->pseudo);
    }

    /**
     * Get the value of mail
     */ 
    public function getMail()
    {
        return htmlspecialchars($this->mail);
    }

    /**
     * Get the value of password
     */ 
    public function getPassword()
    {
        return htmlspecialchars($this->password);
    }

    /**
     * Get the value of role
     */ 
    public function getRole()
    {
        return htmlspecialchars($this->role);
    }
}