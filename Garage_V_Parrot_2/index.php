<?php 

    /* Header */
    require 'includes/functions.php';
    incluTemplates('header');
?>

    <!-- Image et titre -->
    <section class="bg-voiture">
        <h1>Garage V. Parrot</h1>
    </section>

    <!-- Intro Garage V. Parrot -->
    <section class="container container-intro">
        <h3>Garage V. Parrot - Votre Partenaire de Confiance pour la Vente de Voitures d'Occasion à Toulouse</h3>
        <div class="container-intro">
            <div class="image">
                <picture>
                    <img loading="lazy" width="100%" height="auto" src="img/img_intro/2.jpg" alt="image garage voiture">
                </picture>
            </div>
            <div class"text-column">
                <p class="text-intro">Depuis 2021, Vincent Parrot, fort de ses 15 années d'expertise dans la réparation automobile, a ouvert les portes de son propre garage à Toulouse. Au cours des deux dernières années, cet établissement a su se démarquer en offrant une gamme complète de services, allant de la réparation de la carrosserie à l'entretien mécanique, visant à garantir la performance et la sécurité des véhicules. <br><br> Le Garage V. Parrot se distingue également par son engagement envers la vente de voitures d'occasion, offrant à ses clients une sélection soigneusement choisie de véhicules usagés de qualité. </p>
                <p class="text-intro">Pour Vincent Parrot, son atelier représente bien plus qu'un simple lieu de travail : c'est un lieu de confiance où les voitures de ses clients sont traitées avec le plus grand soin. Parce que chaque voiture mérite d'être entre de bonnes mains, le Garage V. Parrot s'engage à fournir un service personnalisé et professionnel, répondant aux besoins spécifiques de chaque client et garantissant leur satisfaction à chaque étape du processus.</p>
             </div>
        </div>
       
    </section>

    <!-- Presentation Services -->
    <section class="section-services">
        <hr>
        <h2 class="titre-services">Nos Services</h2>
        <div class="container-services">
            <div class="service-nettoyage">
                <h3 class="titre-services-h3">Nettoyage Voiture</h3>
                <img src="img/img services/1-lavage-voiture.webp" alt="Image nettoyage voiture">
            </div>
            <div class="service-location">
                <h3 class="titre-services-h3">Location des Voitures</h3>
                <img src="img/img services/2-location-voitures.webp" alt="Image location voiture">
            </div>
            
        </div>
        <a class="btn-green-centrer" href="contact.php">Nous Contacter</a>
        <br>
        <hr>
    </section>

    <!-- Pub Véhicules -->
    <section class="container container-section">
        <h2>Véhicules d'occasion</h2>
        
        <?php 
            $limite = 3;
            include 'includes/templates/vehicules.php'; 
        ?>
        
    <article>
        <?php include 'includes/templates/temoignages.php' ?>
    </article>

    <script src="build/js/app.js"></script>

    <?php 
        incluTemplates('footer'); 
    ?>
