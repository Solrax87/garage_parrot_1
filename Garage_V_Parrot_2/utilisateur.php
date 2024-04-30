<?php


    // Importation à la connexion
    require 'includes/config/database.php';
    // include 'includes/config/database.php';
    $db = conectBD();

    // Creation de email et password 
    // $email = "carlos_rodriguez@garageparrot.com";
    // $password = "11223344";

    // $email = "contact_victor@garageparrot.com";
    // $password = "VParrotG";

    // $email = "farah_vercoutter@garageparrot.com";
    // $password = "11223344";

    $passwordHash = password_hash($password, PASSWORD_BCRYPT);
    
    // Query pour l'utilisateur
    $query = " INSERT INTO utilisateurs (email, password) VALUES ( '{$email}', '{$passwordHash}' );";

    echo $query;
    
    // Ajouter a la BD
    mysqli_query($db, $query);