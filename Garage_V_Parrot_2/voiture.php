<?php 
    $id = $_GET ['id'];
    $id = filter_var($id, FILTER_VALIDATE_INT);

    if(!$id) {
      header('location: /');
    }
    
    //Importation de connéxion
    //require __DIR__ . '/includes/config/database.php'; 
    require 'includes/config/database.php';    //Cualquiera de la dos opciones es valida
    $db = conectBD();
    // Consultation
    $query = "SELECT * FROM vehicules WHERE id = {$id}"; //Asi traemos solo los id requeridos !!!
    // obtention des resultats
    $resultat = mysqli_query($db, $query);

    if(!$resultat->num_rows) {
      header('location: /');
    }

    $option2 = 

    /* Header */
    require 'includes/functions.php';

    incluTemplates('header');

?>


<section class="container section-voiture">
  <?php while($vehicule = mysqli_fetch_assoc($resultat)): ?>
    <h1><?php echo $vehicule['titre']; ?></h1>
    <div class="separation-grid">
        <div class="img-car">
            <img src="/images/<?php echo $vehicule['image1']; ?>" alt="Image voiture BMW">
        </div>

         
        
        <div class="Explicacion">

            <!-- Petite galérie -->
            <div class="galerie-vehicule">
              <div class="img1 car1">
                <img src="/images/<?php echo $vehicule['image1']; ?>" alt="Image voiture BMW">
              </div>
              <div class="img1 car2">
                <img src="/images/<?php echo $vehicule['image2']; ?>" alt="Image voiture galerie">
              </div>

              <div class="img1 car3">
                <img src="/images/<?php echo $vehicule['image3']; ?>" alt="Image voiture galerie">
              </div>

              <div class="img1 car4">
                <img src="/images/<?php echo $vehicule['image4']; ?>" alt="Image voiture galerie">
              </div>
            </div> <!-- Fin class="galerie" -->

            <h3>Prix</h3>
            <p><?php echo number_format($vehicule['prix'], 2, ',', '.'); ?> €</p>
            <hr>
            <h3>Kilomètrage</h3>
            <p><?php echo number_format($vehicule['kilometrage'], 0, '', '.'); ?> km</p>
            <hr>
            <h3>Mise en circulation</h3>
            <p>Première mise en circulation <?php echo $vehicule['date_circulation']; ?></p>
            <hr>
        </div> 
    </div>
    <hr>
</section>
<section class="container option-vehicule">
    <h2>OPTIONS VÉHICULE</h2>
    <ul>
      <li class="option1" id="option1"><?php echo "<pre>"; echo $vehicule['option1']; echo "</pre>"; ?></li>
    </ul>
    <hr>
    <div class="fiche-technique">
        <h2>FICHE TECHNIQUE</h2>
    </div>

    <table class="table">
      <tr>
        <td>MARQUE</td>
        <td><?php echo $vehicule['marque']; ?></td>
      </tr>
      <tr>
        <td>MODÈLE</td>
        <td><?php echo $vehicule['modele']; ?></td>
      </tr>
      <tr>
        <td>BOITE DE VITESSE</td>
        <td><?php echo $vehicule['boite']; ?></td>
      </tr>
      <tr>
        <td>COULEUR</td>
        <td><?php echo $vehicule['couleur']; ?></td>
      </tr>
      <tr>
        <td>KILOMÉTRAGE</td>
        <td><?php echo number_format($vehicule['kilometrage'], 0, '', '.'); ?></td>
      </tr>
      <tr>
        <td>MISE EN CIRCULATION</td>
        <td><?php echo $vehicule['date_creation']; ?></td>
      </tr>
      <tr>
        <td>MOTORISATION</td>
        <td><?php echo $vehicule['puissance'] . 'CH'; ?></td>
      </tr>
      <tr>
        <td>SELLERIE</td>
        <td><?php echo $vehicule['sellerie']; ?></td>
      </tr>
      <tr>
        <td>TYPE DE VÉHICULE</td>
        <td><?php echo $vehicule['type1']; ?></td>
      </tr>
      <tr>
        <td>VERSION</td>
        <td><?php echo $vehicule['version1']; ?></td>
      </tr>
    </table>
  <?php endwhile; ?>

</section>

<!-- Footer -->
<?php 
   mysqli_close($db);
   incluTemplates('footer'); 
?>