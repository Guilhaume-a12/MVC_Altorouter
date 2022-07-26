<?php
namespace App\Models\Users;

use App\Models\ModelClass as Model;
use App\Models\Users\UserClass as User;

class UserManager extends Model {

    public function getUserByPseudoDB($pseudo) {
        $sql = "SELECT * FROM users WHERE pseudo = :pseudo";
        $stmt = $this->getBdd()->prepare($sql);
        $stmt->execute([
            ":pseudo" => $pseudo
        ]);
        $data = $stmt->fetch(\PDO::FETCH_OBJ);
        if ($data) {
            $user = new User($data->id,$data->pseudo,$data->mail,$data->password,$data->role);
            return $user;
        } else {
            return null;
        }
    }

    public function addUserDB($pseudo,$mail,$password) {
        $sql = "INSERT INTO users (pseudo,mail,password,role) VALUES (:pseudo,:mail,:password,'user')";
        $stmt = $this->getBdd()->prepare($sql);
        if ($stmt->execute([":pseudo"=>$pseudo,":mail"=>$mail,":password"=>$password])) {
            return true;
        } else {
            return false;
        }
    }
}