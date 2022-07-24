<?php
namespace App\Models\Books;

class BookClass {

    public function __construct(
        private int $id,
        private string $title,
        private int $pages,
        private string $image
    ) {}

    public function getId() {
        return htmlspecialchars($this->id);
    }
    public function setId($id) {
        $this->id = $id;
    }

    public function gettitle() {
        return htmlspecialchars($this->title);
    }
    public function settitle($title) {
        $this->title = $title;
    }

    public function getpages() {
        return htmlspecialchars($this->pages);
    }
    public function setpages($pages) {
        $this->pages = $pages;
    }

    public function getImage() {
        return htmlspecialchars($this->image);
    }
    public function setImage($image) {
        $this->image = $image;
    }
}