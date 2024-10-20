<?php
    class AuthView {

        public function authError($error) {
            require 'templates/layout/header.phtml';
            echo $error;
        }
    }