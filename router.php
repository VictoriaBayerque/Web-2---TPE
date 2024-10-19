<?php
include_once "./app/controllers/base.controller.php";
include_once "./app/controllers/user.controller.php";
include_once "./app/controllers/library.controller.php";
include_once "./app/controllers/authors.controller.php";
include_once "./libs/user_response.php";
include_once "./app/middlewares/sessionverify.php";

define('BASE_URL', '//'.$_SERVER['SERVER_NAME'] . ':' . $_SERVER['SERVER_PORT'] . dirname($_SERVER['PHP_SELF']).'/');

$loggedUser = new UserSession();

if (!empty($_GET['action'])) {
    $action = $_GET['action'];
} else {
    $action = 'home';
}

$params = explode('/', $action);

$baseController = new BaseController();
$userController = new UserController();
$libraryController = new LibraryController();
$authorsController = new AuthorsController();

switch ($params[0]) {
    case 'home':
        $baseController->showHome();
        break;
    case 'library':
        $libraryController->showLibrary();
        break;
    case 'authors':
        $authorsController->showAuthors();
        break;
    case 'book':
        if (isset($params[1])) {
            $libraryController->showBook($params[1]);
        } else {
            $libraryController->showLibrary();
        }
        break;
    case 'addBookForm':
        $libraryController->addBookView();
        break;
    case 'addBook':
        $libraryController->addBook();
        break;
    case 'erase':
        if (isset($params[1])) {
            $libraryController->deleteBook($params[1]);
        }
        break;
    case 'modifyForm':
        $libraryController->modifyBookForm($params[1]);
        break;
    case 'saveBook':
        $libraryController->saveBook($params[1]);
        break;
    case 'registerform':
        $userController->showRegisterForm();
        break;
    case 'registeruser':
        $userController->registerUser();
        break;
    case 'loginform':
        $userController->showLoginForm();
        break;
    case 'loginuser':
        $userController->loginUser();
        break;
    case 'logoutuser':
        $userController->logoutUser();
        break;
    default:
        echo '404 Page not found';
        break;
}