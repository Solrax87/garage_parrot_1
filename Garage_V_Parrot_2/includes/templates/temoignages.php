<?php 


$resultat = $_GET['resultat'] ?? null;

//  echo "<pre>";
//  var_dump($_POST);
//  echo "</pre>";

    
    // Ecrire le Query
    $query_temoignages = "SELECT * FROM temoignages LIMIT 6";
    // Consultation de BD
    $resultat_temoignages = mysqli_query($db, $query_temoignages);

    $erreures = [];

    $nom = '';
    $compagnie = '';
    $qualification = '';
    $comentaire = '';

    if($_SERVER['REQUEST_METHOD'] === 'POST' ){

        $nom = mysqli_real_escape_string($db, $_POST['nom']);
        $compagnie = isset($_POST['compagnie']) ? mysqli_real_escape_string($db, $_POST['compagnie']) : '';
        $qualification = mysqli_real_escape_string($db, $_POST['qualification']);
        $comentaire = mysqli_real_escape_string($db, $_POST['comentaire']);

        if(!$nom) {
            $erreures[] = "Nom Oubligatoire";
        }

        /* $compagnie pas obligatoire */

        // if(!$compagnie) {
        //     $erreures[] = "Compagnie Oubligatoire";
        // }

        if(!$qualification) {
            $erreures[] = "Qualification Oubligatoire";
        }
        if(strlen(!$comentaire) > 60 ) {
            $erreures[] = "Comentaire Oubligatoire";
        }

        if(empty($erreures)) {

            $query = "INSERT INTO temoignages (nom, compagnie, qualification, comentaire) VALUES ('$nom', '$compagnie', '$qualification', '$comentaire')";

            $resultat = mysqli_query($db, $query);

        }
        
    }

?>

</div>
<section class="container container-temoins">
        <hr>
        <h2 class="titre-temoin">Témoignages</h2>
        <div class="temoins">
            <?php while($temoignages = mysqli_fetch_assoc($resultat_temoignages)): ?>
            
            <div class="temoin">
                <h4><?php echo $temoignages['comentaire']; ?></h4>
                <h4>Compagnie : <?php echo $temoignages['compagnie']; ?></h4>
                <h4>Qualification : <?php echo $temoignages['qualification']; ?></h4>
                <p class="signature"><?php echo $temoignages['nom']; ?></p>
            </div>
            
            <?php endwhile; ?>
        </div>
    </section>    

    <section class="container">
        <div class="container-formulaire section">
            <h2>Laissez votre témoignage</h2>

            <form id="formulaire" class="formulaire" method="POST" action="/">
                <label for="nom">Nom :</label>
                <input type="text" id="nom" name="nom" required>

                <label for="compagnie">Compagnie :</label>
                <input type="text" id="compagnie" name="compagnie">

                <label for="qualification">Qualification:</label>
                <select id="qualification" name="qualification">
                    <option value="" disabled selected>-- Choisissez une option --</option>
                    <option value="Terrible">1 - Terrible</option>
                    <option value="Peu Satisfait">2 - Peu Satisfait</option>
                    <option value="Moyen">3 - Moyen</option>
                    <option value="Bien">4 - Bien</option>
                    <option value="Excellent">5 - Excellent</option>
                </select>    
        
                <label for="comentaire">Comentaire:</label>
                <textarea id="comentaire" maxLength="100" name="comentaire" rows="4" cols="50" required></textarea>
        
                <button type="submit" id="modal1" onclick="return confirmation()">Envoyer</button>
            </form>
        </div>
    </section>



