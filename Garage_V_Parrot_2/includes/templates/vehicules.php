<?php
    // Importation de connéxion
    require __DIR__ . '/../config/database.php'; 
    //require 'includes/config/database.php'; //Cualquiera de la dos opciones es valida
    $db = conectBD();

    // Consultation
    $query = "SELECT * FROM vehicules LIMIT {$limite}";
    // $query_temoignages = "SELECT * FROM temoignages LIMIT 6";
    

        // Obtención de parámetros de filtro
        $minPrice = isset($_GET['prix_min']) ? $_GET['prix_min'] : 0;
        $maxPrice = isset($_GET['prix_max']) ? $_GET['prix_max'] : 1000000;

         // Si se proporcionan parámetros de filtro, construir la consulta filtrada
        if ($minPrice !== 0 || $maxPrice !== 1000000) {
            $query = "SELECT * FROM vehicules WHERE prix >= $minPrice AND prix <= $maxPrice LIMIT 9";
        }

    // obtention des resultats
    $resultat = mysqli_query($db, $query);
    

    /** Espace pour temoignages */

    // Array message erreur
    

    // echo "<pre>";
    // var_dump($query);
    // echo "</pre>";

?>


    <div class="all-publicite">
        
        <?php while($vehicule = mysqli_fetch_assoc($resultat)): ?>
        <div class="publicite">

                <img loading="lazy" src="/images/<?php echo $vehicule['image1']; ?>" alt="image voiture Mitsubishi">

            <div class="container-publicite">
                <h3><?php echo $vehicule['titre']; ?></h3>
                <h4><?php echo number_format($vehicule['kilometrage'], 0, '', '.'); ?> km</h4>
                <h4><?php echo 'Mise en Circulation / ' . $vehicule['date_circulation']; ?></h4>
                <h4><?php echo 'Carburant / ' . $vehicule['energie']?></h4>
                <p class="prix"><?php echo number_format($vehicule['prix'], 2, ',', '.'); ?> €</p>

                <a href="voiture.php?id=<?php echo $vehicule['id']; ?>" class="btn-yellow">
                    Voir Véhicule
                </a>
            </div><!--.container-publicite-->
        </div><!--.publicite-->
        <?php endwhile; ?>
    </div>

                <!-- Bouton lien véhicules -->
                <a class="btn-green-centrer" href="vehicules.php">Voir plus</a>
    </section>
    
    <!-- Section Témoignages -->


