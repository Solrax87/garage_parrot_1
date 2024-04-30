<?php
    // BD
    require __DIR__ . '/includes/config/database.php'; 

    // Connection
    $db = conectBD();

    // Opténtion de parametrage du filtre
    $minPrice = isset($_GET['prix_min']) ? $_GET['prix_min'] : 0;
    $maxPrice = isset($_GET['prix_max']) ? $_GET['prix_max'] : 150000;

    // Filtrage par prix avec limitateur
    $query = "SELECT * FROM vehicules WHERE prix >= $minPrice AND prix <= $maxPrice LIMIT 12";

    // Obtention de resultat
    $resultat = mysqli_query($db, $query);
?>

<div class="all-publicite">
    <?php while($vehicule = mysqli_fetch_assoc($resultat)): ?>
        <div class="publicite">
            <!-- Aquí va el HTML para la presentación de cada vehículo -->
            <img loading="lazy" src="/images/<?php echo $vehicule['image1']; ?>" alt="Imagen de vehículo">
            <div class="container-publicite">
                <h3><?php echo $vehicule['titre']; ?></h3>
                <h4><?php echo number_format($vehicule['kilometrage'], 0, '', '.'); ?> km</h4>
                <h4><?php echo 'Mise en Circulation / ' . $vehicule['date_circulation']; ?></h4>
                <h4><?php echo 'Carburant / ' . $vehicule['energie']; ?></h4>
                <p class="prix"><?php echo number_format($vehicule['prix'], 2, ',', '.'); ?> €</p>
                <a href="voiture.php?id=<?php echo $vehicule['id']; ?>" class="btn-yellow">Voir Véhicule</a>
            </div><!-- .container-publicite -->
        </div><!-- .publicite -->
    <?php endwhile; ?>
</div>

<?php
    // Cierre de la conexión a la base de datos
    mysqli_close($db);
?>
