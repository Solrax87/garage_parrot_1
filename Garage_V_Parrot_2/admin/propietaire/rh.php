<?php 
    // Authentification d'utilisateur
    require '../../includes/functions.php';
    $auth = authentifie();

    // echo "<pre>";
    // var_dump($auth);
    // echo "</pre>";

    

    //Base de donne (connexion)
    require '../../includes/config/database.php';
    $db = conectBD();

    // Array message erreur
    $erreures = [];

    $nom = '';
    $prenom = '';
    $telephone = '';
    $email = '';
    $password = '';
    $rol = '';

    // Execution du code après l'envoi du formulaire
    if($_SERVER['REQUEST_METHOD'] === 'POST' ){
        

        // Assainir 
        $nom = mysqli_real_escape_string($db, $_POST['nom']);
        $prenom = mysqli_real_escape_string($db, $_POST['prenom']);
        $telephone = mysqli_real_escape_string($db, $_POST['telephone']);
        $email = mysqli_real_escape_string($db, $_POST['email']);
        $password = mysqli_real_escape_string($db, $_POST['password']);

        if(!$nom) {
            $erreures[] = "Nom Oubligatoire";
        }
        if(!$prenom) {
            $erreures[] = "Prènom Oubligatoire";
        }
        if(!$telephone) {
            $erreures[] = "Téléphone Oubligatoire";
        }
        if(!$email) {
            $erreures[] = "Email Oubligatoire";
        }
        if(strlen($password) < 4) {
            $erreures[] = "Mot de Pass Oubligatoire, 4 caractères minimum";
        }
        if(isset($_POST['rol'])) {
            $rol = mysqli_real_escape_string($db, $_POST['rol']);
        } else {
            $erreures[] = "Rôle obligatoire";
        }

        // echo "<pre>";
        // var_dump($erreures);
        // echo "</pre>";

        //Array vide

        if(empty($erreures)) {
            $passwordHash = password_hash($password, PASSWORD_BCRYPT);
            
            //Insertion dans la BD
            $query = "INSERT INTO vendeurs (nom, prenom, telephone, email, password, rol) VALUES ('$nom', '$prenom', '$telephone', '$email', '{$passwordHash}', '$rol' )";

            // echo $query;

            // Insertion a la BD
            $resultat = mysqli_query($db, $query);

            if($resultat) {
                header('Location: /admin/propietaire/administrateur.php?resultat=1');
            }   
        }
    }
    // Vérifier si l'utilisateur est connecté et a le role d'administrateur
if (!isset($_SESSION['login']) || $_SESSION['rol'] !== 'administrateur') {
    // Si l'utilisateur n'a pas la permission, le rediriger vers une autre page
    header('Location: /admin/after_login.php');
    exit; 
}
    if(!$auth) {
        header('Location: /login.php');
        exit;
    }
    
    /* HEADER */
    incluTemplates('header');
?>

<main class="container section formulaire-centre">
    <h1>CREATEUR D'UTILISATEURS</h1>

    <a href="/admin/propietaire/administrateur.php" class="btn-green">Revenir</a>

    <?php foreach($erreures as $erreur): ?>
        <div class="alerte erreur">
            <?php echo $erreur; ?>
        </div>
        
    <?php endforeach; ?>

   <div>
        <div>

            <form method="POST" class="formulaire" action="/admin/propietaire/rh.php">
                <fieldset>
                    <legend>Email et Password</legend>

                    <label for="nom">Nom</label>
                    <input type="text" name="nom" id="nom" value="<?php echo $nom; ?>">

                    <label for="prenom">Prènom</label>
                    <input type="text" name="prenom" id="prenom" value="<?php echo $prenom; ?>">

                    <label for="telephone">Téléphone</label>
                    <input type="tel" name="telephone" id="telephone" value="<?php echo $telephone; ?>">

                    <label for="email">E-mail</label>
                    <input type="email" name="email" id="email" value="<?php echo $email; ?>">

                    <label for="password">Mot de Passe</label>
                    <input type="password" name="password" id="password" value="<?php echo $password; ?>">

                    <select id="rol" name="rol">
                        <option value="" disabled selected>-- Choisissez une option --</option>
                        <option value="1">Employer</option>
                        <option value="2">Administrateur</option>
                    </select>

                </fieldset>
                <input type="submit" class="btn-green" value="Enrôler">
            </form>
        </div>

   </div>

</main>




<!-- Footer -->
<?php 
        incluTemplates('footer'); 
    ?>
