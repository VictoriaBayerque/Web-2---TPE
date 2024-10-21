<?php

class AuthorsView {

    public function showError($error) {
        require 'templates/error.phtml';
    }
    public function displayAuthors($authors) {
        require 'templates/authors_template.phtml';
    }
    public function displayAuthor($author){
        require 'templates/author_template.phtml';
    }
    public function displayAddAuthor() {
        require 'templates/forms/addauthorform.phtml';
    }
    public function modifyAuthor($author) {
        require 'templates/forms/modifyauthorform.phtml';
    }
}