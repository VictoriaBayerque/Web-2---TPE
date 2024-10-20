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
    //------------------HOME
    case 'home':
        $baseController->showHome();
        break;
    //------------------BOOKS
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
    //------------------AUTHORS
    case 'author':
        $author = htmlspecialchars($params[1]);
        if (isset($author)) {
            $authorsController->showAuthor($author);
        } else {
            $authorsController->showAuthors();
        }
        break;
    case 'addAuthorForm':
        verifySession($user);
        $authorsController->addAuthorView();
        break;
    case 'addAuthor':
        verifySession($user);
        $authorsController->addAuthor();
        break;
    case 'eraseauthor':
        verifySession($user);
        if (isset($params[1])) {
            $authorsController->deleteAuthor($params[1]);
        }
        break;
    case 'modifyauthor':
        verifySession($user);
        $authorsController->modifyAuthorForm($params[1]);
        break;
    case 'saveauthor':
        verifySession($user);
        $authorsController->saveAuthor($params[1]);
        break;
    //------------------USERS
    case 'registerform':
        verifySession($user); //Queda con permiso para que nadie pueda entrar y registrarse, asi no tengo que comentar esto ni donde lo llamo
        $userController->showRegisterForm();
        break;
    case 'registeruser':
        verifySession($user);//Queda con permiso para que nadie pueda entrar y registrarse, asi no tengo que comentar esto ni donde lo llamo
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