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
        
        public function showAuthor($id) {
            $author = $this->model->getAuthor($id);
            return $this->view->displayAuthor($author);
        }
        public function getAuthor($id) {
            $author = $this->model->getAuthor($id);
            return $author;
        }
        public function addAuthor() {
            if ($_FILES['authorimg']['name']) {
                if ($_FILES['authorimg']['type'] == "image/jpeg" ||
                $_FILES['authorimg']['type'] == "image/jpg" ||
                $_FILES['authorimg']['type'] == "image/png") {
                    
                    $this->model->insertAuthor(
                        $_POST['authorname'],
                        $_POST['authorage'],
                        $_POST['authoractivity'],
                        $_FILES['authorimg']
                    );
                }
                else {
                    $this->view->showError("Insert a valid file type");
                    die();
                }
            }
            else {
                $this->model->insertAuthor(
                    $_POST['authorname'],
                    $_POST['authorage'],
                    $_POST['authoractivity'],
                ); 
            }
            header("Location: " . BASE_URL . "authors");
        }
        public function deleteAuthor($id) {
            $author = $this->model->getAuthor($id);
            if (!$author){
                return $this->view->showError('The author does not exist in the database');
            }
            $this->model->eraseAuthor($id);

            header('Location: ' . BASE_URL);
        } 
        public function saveAuthor($id) { 
            if ($id) {
                if ($_FILES['authorimg']['name']) {
                    if ($_FILES['authorimg']['type'] == "image/jpeg" ||
                    $_FILES['authorimg']['type'] == "image/jpg" ||
                    $_FILES['authorimg']['type'] == "image/png") {
                    
                    $this->model->updateAuthor(
                        $id,
                        $_POST['authorname'],
                        $_POST['authorage'],
                        $_POST['authoractivity'],
                        $_FILES['authorimg']
                    );
                    } else {
                        $this->view->showError("Insert a valid file type");
                        die();
                    }
                } else {
                    $this->model->updateAuthor(
                        $id,
                        $_POST['authorname'],
                        $_POST['authorage'],
                        $_POST['authoractivity'],
                    ); 
                }
            } else {
                return $this->view->showError('It is not possible to save the author');
            }
            header('Location: ' . BASE_URL . 'authors');
        }
        public function addAuthorView() {
            return $this->view->displayAddAuthor();
        }
        public function modifyAuthorForm($id) {
            $author = $this->model->getAuthor($id);
            return $this->view->modifyAuthor($author);
        }
    }

