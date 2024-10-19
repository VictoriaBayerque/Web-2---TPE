<?php
    include_once './app/models/authors.model.php';
    include_once './app/views/authors.view.php';

    class AuthorsController {
        private $model;
        private $view;

        public function __construct() {
            $this->model = new authorsModel();
            $this->view = new authorsView();
        }
        public function showAuthors() {
            $authors = $this->model->getAuthors();
            return $this->view->displayAuthors($authors);
        }
        public function showAuthor($name) {
            $author = $this->model->getAuthor($name);
            return $this->view->displayAuthor($author);
        }

        public function addAuthor() {
            if (!isset($_POST['name']) || empty($_POST['name'])) {  
                return $this->view->showError('You must insert the name');
            }
            $name = $_POST['name'];
            $age = $_POST['age'];
            $activity = $_POST['activity'];

            $this->model->insertBook($name, $age, $activity);

            header('Location: ' . BASE_URL);
        }
        public function deleteBook($name) {
            $author = $this->model->getAuthor($name);
            if (!$author){
                return $this->view->showError('The author does not exist in the database');
            }
            $this->model->eraseAuthor($name);

            header('Location: ' . BASE_URL);
        } 
        public function saveAuthor($name) { 
            $author = $this->model->getAuthor($name);
            if (!$author){
                return $this->view->showError('It is not possible to save the author');
            }
            $this->model->updateAuthor($name);
            header('Location: ' . BASE_URL);
        }    
    }

