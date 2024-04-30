<?php 

    require '../includes/functions.php';
    $auth = authentifie();

    if(!$auth) {
        header('Location: /');
    }

    // Importer la connexion
    require '../includes/config/database.php';
    $db = conectBD();

    // Ecrire le Query
    $query = "SELECT * FROM vehicules";

    // Consultation de BD
    $resultat = mysqli_query($db, $query);


    // Obtention de BD pour les voitures
    // $consultation = "SELECT * FROM vehicules WHERE id = {$id}";
    // $resultat =mysqli_query($db, $consultation);

    // echo $consultation;


    // Message de resultat
    $enregistrement = $_GET['enregistrement'] ?? null;

    if($_SERVER['REQUEST_METHOD'] === 'POST') {
        $id = $_POST ['id'];
        $id = filter_var($id, FILTER_VALIDATE_INT);

        if($id) {
            // Effacer le fichier
            $query = "SELECT image1 FROM vehicules WHERE id = {$id}";

            $resultat = mysqli_query($db, $query);
            $vehicule = mysqli_fetch_assoc($resultat);
            
            unlink('../images/' . $vehicule['image1']);

            // Effacer le vehicule
            $query = "DELETE FROM vehicules WHERE id = {$id}";
            $resultat = mysqli_query($db, $query);

            if($resultat) {
                header('Location: /admin?enregistrement=3');
            }
        }
        
    }




    // Inclusion de template

    incluTemplates('header');

?>

<main class="container">
    <h1>Administrateur des Véhicules</h1>
    <?php if( intval( $enregistrement ) === 1):  ?>
        <p class="alerte succes">Vehicule Enregistré Correctement</p>
    <?php elseif (intval( $enregistrement ) === 2): ?>
        <p class="alerte succes">Mise à Jour Du Véhicule Effectuée</p>
        <?php elseif (intval( $enregistrement ) === 3): ?>
        <p class="alerte succes">Effacé Correctement</p>
    <?php endif; ?>

    <div class="btn-admin">
        <a href="/admin/propietaire/administrateur.php" class="btn-green" id="btn-rol">Revenir en Arrière</a>
        <a href="/admin/cars/creer.php" class="btn-green">Créer voiture</a>
    </div>

    <table class="vehicules-all">
        <thead>
            <tr>
                <th>ID</th>
                <th>TITRE</th>
                <th>IMAGE</th>
                <th>PRIX</th>
                <th>KILOMÈTRAGE</th>
                <th>ACTIONS</th>
            </tr>
        </thead>
    
        <tbody> <!-- Montrer les resultat -->
            <?php while($vehicule = mysqli_fetch_assoc($resultat)): ?>
            <tr>
                <td style="text-align: center;"> <?php echo $vehicule['id']; ?> </td>
                <td style="text-align: center;"><?php echo $vehicule['titre']; ?></td>
                <td> <img src="/images/<?php echo $vehicule['image1']; ?>" class="image-table"></td>
                <td><?php echo $vehicule ['prix']; ?> €</td>
                <td style="text-align: center;"><?php echo $vehicule ['kilometrage']; ?></td>
                <td> 
                    <form method="POST" class="w-100"> <!-- class="w-100" ubication dans _admin.scss -->

                        <input type="hidden" name="id" value="<?php echo $vehicule['id']; ?> ">

                        <input type="submit" class="btn-red" value="Effacer" onclick="return confirmation2()">
                    </form>
                    <a href="../admin/cars/actualiser.php?id= <?php echo $vehicule['id'];?> " 
                       class="btn-blue">Mettre à jour</a>
                </td>
            </tr>
            <?php endwhile; ?>
        </tbody>
    </table>

</main>




<!-- Footer -->
<?php 
    // Fermeture de connexion
    mysqli_close($db);

    incluTemplates('footer'); 
?>
