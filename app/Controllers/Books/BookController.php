<?php

namespace App\Controllers\Books;

use App\Controllers\CoreController;
use App\Models\Books\BookManager;


class BookController extends CoreController
{

    private $bookManager;

    public function __construct()
    {
        PARENT::__construct();
        $this->bookManager = new BookManager();
        $this->bookManager->loadingbooks();
    }

    public function displayBooks()
    {
        $books = $this->bookManager->getBooks();
        require "../app/Views/Books/booksView.php";
    }

    public function displayBook($id)
    {
        $book = $this->bookManager->getBookById($id);
        if (!$book) {
            throw new \Exception('Le livre que vous recherchez n\'existe pas.');
        }
        require "../app/Views/Books/bookView.php";
    }

    public function displayAddBook()
    {
        require "../app/Views/Books/addBookView.php";
    }

    public function addBookValidate()
    {
        if (empty($_POST['title']) || empty($_POST['pages'])) {
            $this->alert("danger", "All fields must be completed");
            header("location:" . $this->router->generate('books-add'));
            exit;
        }
        $file = $_FILES['image'];
        $dir = "images/";
        $image = $this->addImage($_POST['title'], $file, $dir);
        $result = $this->bookManager->addBookDB($_POST['title'], $_POST['pages'], $image);
        $this->alert("success", "The book was successfully added");
        header("location:" . $this->router->generate('books'));
    }

    public function displayDeleteBook($id)
    {
        $book = $this->bookManager->getBookById($id);
        require "../app/Views/Books/deleteBookView.php";
    }

    public function deleteBook($id)
    {
        if (isset($_POST['btnDel'])) {
            $myImage = $this->bookManager->getBookById($id)->getImage();
            unlink("images/" . $myImage);
            $this->bookManager->deleteBookDB($id);
            $this->alert("success", "Book deleted successfully");
            header("location:" . $this->router->generate('books'));
            exit;
        } else {
            header("location:" . $this->router->generate('home'));
            exit;
        }
    }

    public function displayUpdateBook($id)
    {
        $book = $this->bookManager->getBookById($id);
        require "../app/Views/Books/updateBookView.php";
    }

    public function updateBookValidate()
    {
        if (empty($_POST['title']) || empty($_POST['pages'])) {
            $this->alert("danger", "'Title' and 'pages' must be completed");
            header("location:" . $this->router->generate('books-update',["id" => $_POST['id']]));
            exit;
        }
        $currentImg = $this->bookManager->getBookById($_POST['id'])->getImage();
        $file = $_FILES['image'];

        if ($file['size'] > 0) {
            unlink("images/" . $currentImg);
            $dir = "images/";
            $imgToAdd = $this->addImage($_POST['title'], $file, $dir);
        } else {
            $imgToAdd = $currentImg;
        }
        $this->bookManager->updateBookDB($_POST['id'], $_POST['title'], $_POST['pages'], $imgToAdd);
        $this->alert("success", "The book has been successfully updated");
        header("location:" . $this->router->generate('books'));
    }
}
