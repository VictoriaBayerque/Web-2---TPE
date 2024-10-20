<?php
include_once "./app/controllers/base.controller.php";
include_once "./app/controllers/user.controller.php";
include_once "./app/controllers/library.controller.php";
include_once "./app/controllers/authors.controller.php";
include_once "./app/middlewares/verifySession.php";
require_once "./libs/user_response.php";

define('BASE_URL', '//'.$_SERVER['SERVER_NAME'] . ':' . $_SERVER['SERVER_PORT'] . dirname($_SERVER['PHP_SELF']).'/');

$user = new UserSession();

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
        verifySession($user);
        $libraryController->addBookView();
        break;
    case 'addBook':
        verifySession($user);
        $libraryController->addBook();
        break;
    case 'erase':
        verifySession($user);
        if (isset($params[1])) {
            $libraryController->deleteBook($params[1]);
        }
        break;
    case 'modifyForm':
        verifySession($user);
        $libraryController->modifyBookForm($params[1]);
        break;
    case 'saveBook':
        verifySession($user);
        $libraryController->saveBook($params[1]);
        break;
    case 'registerform':
        verifySession($user);
        $userController->showRegisterForm();
        break;
    case 'registeruser':
        verifySession($user);
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