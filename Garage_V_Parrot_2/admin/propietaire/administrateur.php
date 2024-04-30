<?php 

$resultat = $_GET['resultat'] ?? null;

require '../../includes/functions.php';
$auth = authentifie();

//  echo "<pre>";
//  var_dump($_POST);
//  echo "</pre>";

    // Importer la connexion
    require '../../includes/config/database.php';
    $db = conectBD();
    // Ecrire le Query
    $query = "SELECT * FROM vendeurs";
    // Consultation de BD
    $resultat = mysqli_query($db, $query);

    if($_SERVER['REQUEST_METHOD'] === 'POST') {
        $id = $_POST['id'];
        $id = filter_var($id, FILTER_VALIDATE_INT);

        if($id) {
            $query = "DELETE FROM vendeurs WHERE id = {$id}";
            $resultat = mysqli_query($db, $query);

            if($resultat) {
                header('Location: /admin/propietaire/administrateur.php');
            }
        }
    }

// Vérifier si l'utilisateur est connecté et a le role d'administrateur
if (!isset($_SESSION['login']) || $_SESSION['rol'] !== 'administrateur') {
    // Si l'utilisateur n'a pas la permission, le rediriger vers une autre page
    header('Location: /admin/after_login.php');
    exit; 
}

    // Redirection du URL selon le rôle
    // $redirectURL = '';
    // if ($auth['rol'] === 'administrateur') {
    //     $redirectURL = '/../admin/propietaire/administrateur.php';
    // } elseif ($auth['rol'] === 'employer') {
    //     $redirectURL = '/../admin/temoignages/after_login.php';
    // }



    
    incluTemplates('header');
?>

<section>
    <h1>ADMINISTRATEUR</h1>
</section>

    <div class="btn-admin container">

        <div>
            <a class="btn-green" href="/admin">ADMIN VÉHICULES</a>
        </div>
        <div>
        <a class="btn-green" href="/admin/propietaire/rh.php">nouvel utilisateur</a>
        </div>
        <div>
            <a class="btn-green" href="/admin/temoignages/temoignages.php"> Admin Temoignages</a>
        </div>
        
    </div>
<section class="container">
    <?php if(intval($resultat === 1)):  ?>
        <p class="alerte succes">Utilisateur Enregistré</p>
    <?php endif; ?>

    <table class="vehicules-all">
        <thead>
           <tr>
            <th>ID</th>
            <th>NOM</th>
            <th>EMAIL</th>
            <th>RÔLE</th>
            <th>ACTIONS</th>
           </tr> 
        </thead>

        <tbody> <!-- Resultat de la BD -->
        <?php while($vendeurs = mysqli_fetch_assoc($resultat)): ?>
            <tr>
                <td style="text-align: center;"><?php echo $vendeurs['id']; ?></td>
                <td style="text-align: center;"><?php echo $vendeurs['nom']; ?></td>
                <td style="text-align: center;"><?php echo $vendeurs['email']; ?></td>
                <td style="text-align: center;"><?php echo $vendeurs['rol']; ?></td>
                <td >
                     <form method="POST" class="w-100"> <!-- class="w-100" ubication dans _admin.scss -->
                        <input type="hidden" name="id" value="<?php echo $vendeurs['id']; ?> ">
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
