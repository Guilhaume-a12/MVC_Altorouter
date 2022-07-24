<?php

// Display books **************************************
$router->map('GET','/books',[
    "controller" => "App\Controllers\Books\BookController",
    "method" => "displayBooks"
],'books');


// Read a book **************************************
$router->map('GET','/books/read/[i:id]',[
    "controller" => "App\Controllers\Books\BookController",
    "method" => "displayBook"
],'books-read');


// Add books **************************************
$router->map('GET','/books/add',[
    "controller" => "App\Controllers\Books\BookController",
    "method" => "displayAddBook"
],'books-add');

$router->map('POST','/books/add-validate',[
    "controller" => "App\Controllers\Books\BookController",
    "method" => "addBookValidate"
],'books-add-validate');


// Update books **************************************
$router->map('GET','/books/update/[i:id]',[
    "controller" => "App\Controllers\Books\BookController",
    "method" => "displayUpdateBook"
],'books-update');

$router->map('POST','/books/update-validate',[
    "controller" => "App\Controllers\Books\BookController",
    "method" => "UpdateBookValidate"
],'books-update-validate');


// Delete books **************************************
$router->map('GET','/books/delete/[i:id]',[
    "controller" => "App\Controllers\Books\BookController",
    "method" => "displayDeleteBook"
],'books-delete');

$router->map('POST','/books/delete-validate/[i:id]',[
    "controller" => "App\Controllers\Books\BookController",
    "method" => "deleteBook"
],'books-delete-validate');