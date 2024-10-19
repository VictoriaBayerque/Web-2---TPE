<?php

class AuthorsView {

    public function showError($error) {
        require 'templates/error.phtml';
        echo $error;
    }
    public function displayAuthors($authors) {
        require 'templates/layout/header.phtml';
        require 'templates/authors_template.phtml';
    }
    public function displayAuthor($author){
        require 'templates/layout/header.phtml';
        if (!$author) {
            echo "<p>The requested author has not been found.</p>";
            return;
        } else {
            require 'templates/book_template.phtml';//NOOOOOO!!!!!!!!!!!!!!!!!
        }
    }
}