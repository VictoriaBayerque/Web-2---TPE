<?php

class LibraryView {

    public function showError($error) {
        require 'templates/error.phtml';
    }
    public function displayLibrary($library, $authors) {
        require 'templates/library_template.phtml';
    }
    public function displayBook($book, $author) {
        require 'templates/book_template.phtml';
    }
    public function displayAddBook($authors) {
        require 'templates/forms/addbookform.phtml';
    }
    public function modify($book, $authors) {
        require 'templates/forms/modifybookform.phtml';
    }
    
}