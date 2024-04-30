<?php

function conectBD() : mysqli {
    $db = mysqli_connect('localhost', 'root', '', 'garage_parrot');

    if(!$db) {
        echo "Pas connecté";
        exit;
    }

    return $db;
}