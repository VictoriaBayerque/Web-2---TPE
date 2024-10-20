<?php

class AuthorsView {

    public function showError($error) {
        require 'templates/error.phtml';
        echo $error;
    }
    public function displayAuthors($authors) {
        require 'templates/authors_template.phtml';
    }
    public function displayAuthor($author){
        require 'templates/author_template.phtml';
    }
    public function displayAddAuthor() {
        require 'templates/addauthorform.phtml';
    }
    public function modifyAuthor($author) {
        require 'templates/modifyauthorform.phtml';
    }
}