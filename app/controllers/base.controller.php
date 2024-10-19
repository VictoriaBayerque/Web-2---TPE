<?php
include_once './app/views/base.view.php';

class BaseController {
    private $view;

    public function __construct() {
        $this->view = new BaseView();
    }
    public function showHome($loggedUser) {
        $this->view->displayHome($loggedUser);
    }
}