<?php
    function sessionVerify($userSession) {
        session_start();
        if(isset($_SESSION['ID_USER'])) {
            $userSession->user = new stdClass();
            $userSession->user->userId = $_SESSION['ID_USER'];
            $userSession->user->username = $_SESSION['USERNAME'];
            return;
        } else {
            header("Location: " . BASE_URL . "library");
            die();
        }
    }