<?php

class UserView {

    private $user = null;

    public function displayRegisterForm() {
        require 'registerform.phtml';
    }
    public function displayLoginForm() {
        require 'loginform.phtml';
    }
}
