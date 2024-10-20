<?php

class LibraryView {

    public function showError($error) {
        require 'templates/error.phtml';
    }
    public function displayLibrary($library, $authors) {
        require 'templates/library_template.phtml';
    }
    public function displayAddBook($authors) {
        require 'templates/addbookform.phtml';
    }
    public function displayBook($book, $author) {
        require 'templates/bookies_template.phtml';
    }
    public function modify($book, $authors) {
        require 'templates/modifybookform.phtml';
    }
}