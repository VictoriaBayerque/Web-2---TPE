<?php
include_once './app/views/base.view.php';
include_once './app/controllers/user.controller.php';

class BaseController {
    private $view;

    public function __construct() {
        $this->view = new BaseView();
    }
    public function showHome() {
        $this->view->displayHome();
    }
}