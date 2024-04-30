<?php 
    if(!isset($_SESSION)) {
        session_start();
    }

    $auth = $_SESSION['login'] ?? false;
?>

<!DOCTYPE html>
<html lang="fr">    
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Garage V. Parrot</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Play:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="/build/css/app.css">
    <script src="../../src/js/app.js"></script>
    
</head>
<body>
    <!-- Header -->
    <header class="header">
        <div class="container container-header">

            <!-- Logo -->
            <a class="logo" href="/index.php">
                <img src="/img/logo/logo_garage.png" alt="image logo">
            </a>

            <!-- Menu principale -->
            <nav class="nav-principal">
                <a class="btn-nav" href="/index.php">ACCUEIL</a>
                <a class="btn-nav" href="/vehicules.php">VÉHICULES</a>
                <a class="btn-nav" href="/#horaires">HORAIRES</a>
                <a class="btn-nav" href="/contact.php">CONTACT</a>
                <?php if($auth): ?>
                    <a href="/deconnexion.php">SE DÉCONNECTER</a>
                <?php endif; ?>
            </nav>
        </div>
    </header>