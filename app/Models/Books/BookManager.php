<?php
namespace App\Models\Books;

use App\Models\Books\BookClass;
use App\Models\ModelClass as Model;

class BookManager extends Model {

    private $books = [];

    public function addBook($book) {
        $this->books[] = $book;
    }

    public function getbooks() {
        return $this->books;
    }

    public function getbookById($id) {
        foreach($this->books as $book) {
            if ($book->getId() === $id) {
                return $book;
            }
        }
    }

    public function loadingbooks() {
        $sql = "SELECT * FROM livre";
        $req = $this->getBdd()->prepare($sql);
        $req->execute();
        $data = $req->fetchAll(\PDO::FETCH_OBJ);
        foreach($data as $value) {
            $add = new BookClass($value->id,$value->titre,$value->nbPages,$value->image);
            $this->addBook($add);
        }
    }

    public function addBookDB($title,$pages,$image){
        $sql = "INSERT INTO livre (titre, nbPages, image) values (:titre,:nbPages,:image)";
        $req = $this->getBdd()->prepare($sql);
        $req->execute([
            ":titre"=>$title,
            ":nbPages"=>$pages,
            ":image"=>$image
        ]);
    }

    public function deleteBookDB($id) {
        $sql = "DELETE FROM livre WHERE id = :id";
        $req = $this->getBdd()->prepare($sql);
        $result = $req->execute([
            ":id" => $id
        ]);
    }

    public function updateBookDB($id,$title,$pages,$image) {
        $sql = "UPDATE livre SET titre = :titre, nbPages = :nbPages, image = :image WHERE id = :id";
        $req = $this->getBdd()->prepare($sql);
        $req->execute([
            ":titre" => $title,
            ":nbPages" => $pages,
            ":image" => $image,
            ":id" => $id
        ]);
    }
}