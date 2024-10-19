<?php
    require_once './app/models/library.model.php';
    require_once './app/views/library.view.php';
    require_once './app/models/authors.model.php';

    class LibraryController {
        private $model;
        private $view;

        public function __construct() {
            $this->model = new libraryModel();
            $this->view = new libraryView();
            $this->authorModel = new authorsModel();
        }

        public function showLibrary() {
            $library = $this->model->getLibrary();
            $authors = $this->authorModel->getAuthors();
            return $this->view->displayLibrary($library, $authors);
        }

        public function showBook($id) {
            $book = $this->model->getBook($id);
            if ($book != null) {
                $this->view->displayBook($book);
            } else {
                $this->view->showError("The book does not exist in our database");
            }
        }

        public function addBookView(){
            $authors = $this->authorModel->getAuthors();
            return $this->view->displayAddBook($authors);
        }

        public function addBook() {
            if ($_FILES['bookimg']['name']) {
                if ($_FILES['bookimg']['type'] == "image/jpeg" ||
                $_FILES['bookimg']['type'] == "image/jpg" ||
                $_FILES['bookimg']['type'] == "image/png") {
                    
                    $this->model->insertBook(
                        $_POST['bookname'],
                        $_POST['authorname'],
                        $_POST['seriesname'],
                        $_POST['seriesnumber'],
                        $_POST['summary'],
                        $_FILES['bookimg']
                    );
                }
                else {
                    $this->view->showError("Insert a valid file type");
                    die();
                }
            }
            else {
                $this->model->insertBook(
                    $_POST['bookname'],
                    $_POST['authorname'],
                    $_POST['seriesname'],
                    $_POST['seriesnumber'],
                    $_POST['summary']);  
            }
            header("Location: " . BASE_URL . "library");
        }

        public function deleteBook($id) {
            $book = $this->model->getBook($id);
            if (!$book){
                return $this->view->showError('The book does not exist in the database');
            }
            $this->model->eraseBook($id);

            header("Location: " . BASE_URL . "library");
        }

        public function modifyBookForm($id) {
            $authors = $this->authorModel->getAuthors();
            $book = $this->model->getBook($id);
            return $this->view->modify($book, $authors);
        }

        public function saveBook($book_id) {
            if ($book_id){
                if ($_FILES['bookimg']['name']) {
                    if ($_FILES['bookimg']['type'] == "image/jpeg" ||
                    $_FILES['bookimg']['type'] == "image/jpg" ||
                    $_FILES['bookimg']['type'] == "image/png") {
                        
                        $this->model->updateBook(
                            $book_id,
                            $_POST['bookname'],
                            $_POST['authorname'],
                            $_POST['seriesname'],
                            $_POST['seriesnumber'],
                            $_POST['summary'],
                            $_FILES['bookimg']
                        );
                    }
                    else {
                        $this->view->showError("Insert a valid file type");
                        die();
                    }
                } else {
                    $this->model->updateBook(
                        $book_id,
                        $_POST['bookname'],
                        $_POST['authorname'],
                        $_POST['seriesname'],
                        $_POST['seriesnumber'],
                        $_POST['summary']);
                }
            } else {
                return $this->view->showError('It is not possible to save the book');
            }
            header("Location: " . BASE_URL . "library");
        }
    }

