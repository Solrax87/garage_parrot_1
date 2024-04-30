<?php 

    require 'app.php';

    function incluTemplates (string $nom ) {
        include TEMPLATES_URL . "/{$nom}.php";
    }

    function authentifie() : bool {
        session_start();

        $auth = $_SESSION['login'];
        if($auth){
            return true;
        }
        return false;
    }