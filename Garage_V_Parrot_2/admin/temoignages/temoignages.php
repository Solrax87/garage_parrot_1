<?php 

require '../../includes/functions.php';
$auth = authentifie();
$resultat = $_GET['resultat'] ?? null;

//  echo "<pre>";
//  var_dump($_POST);
//  echo "</pre>";

    // Importer la connexion
    require '../../includes/config/database.php';
    $db = conectBD();
    // Ecrire le Query
    $query = "SELECT * FROM temoignages";
    // Consultation de BD
    $resultat = mysqli_query($db, $query);

    if($_SERVER['REQUEST_METHOD'] === 'POST') {
        $id = $_POST['id'];
        $id = filter_var($id, FILTER_VALIDATE_INT);

        if($id) {
            $query = "DELETE FROM temoignages WHERE id = {$id}";
            $resultat = mysqli_query($db, $query);

            if($resultat) {
                header('Location: /admin/propietaire/administrateur.php');
            }
        }
    }

    if(!$auth) {
        header('Location: /login.php');
        exit;
    }
    


    /** Header */
    
    incluTemplates('header');
?>

<section>
    <h1>ADMINISTRATEUR DE TÉMOIGNAGES</h1>
</section>

<div class="btn-admin container">

    <div>
        <a class="btn-green" href="/admin/propietaire/administrateur.php">Venir en Arrier</a>
    </div>

</div>
<section class="container">
    <?php if(intval($resultat === 1)):  ?>
        <p class="alerte succes">Témoignage Effacé</p>
    <?php endif; ?>
    <div>
        <p class="text-importante">* Supprimer toujours le premier de la liste pour que les nouveaux messages soient reflétés sur la page principale.</p>
        <p class="text-importante">* 1 message par jour</p>
    </div>

    <table class="vehicules-all">
        <thead>
           <tr>
            <th>ID</th>
            <th>NOM</th>
            <th>COMPAGNIE</th>
            <th>QUALIFICATION</th>
            <th>COMMENTAIRE</th>
            <th>ACTIONS</th>
           </tr> 
        </thead>

        <tbody> <!-- Resultat de la BD -->
        <?php while($temoinages = mysqli_fetch_assoc($resultat)): ?>
            <tr>
                <td style="text-align: center;"><?php echo $temoinages['id']; ?></td>
                <td style="text-align: center;"><?php echo $temoinages['nom']; ?></td>
                <td style="text-align: center;"><?php echo $temoinages['compagnie']; ?></td>
                <td style="text-align: center;"><?php echo $temoinages['qualification']; ?></td>
                <td style="text-align: center;"><?php echo $temoinages['comentaire']; ?></td>
                <td >
                     <form method="POST" class="w-100"> <!-- class="w-100" ubication dans _admin.scss -->
                        <input type="hidden" name="id" value="<?php echo $temoinages['id']; ?> ">
                        <input type="submit" class="btn-red" value="Effacer">
                        
                    </form>
                </td>
            </tr>
            <?php endwhile; ?>
        </tbody>
        
    </table>

</section>

<!-- Footer -->
<?php 
    incluTemplates('footer'); 
?>
