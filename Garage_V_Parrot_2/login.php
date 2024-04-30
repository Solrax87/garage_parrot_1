<?php 
    require 'includes/config/database.php';
    $db = conectBD();
    // Autentification d'utilisateur

    $erreurs = [];

    if($_SERVER['REQUEST_METHOD'] === 'POST' ) {
        // echo "<pre>";
        // var_dump($_POST);
        // echo "</pre>";

        $email = mysqli_real_escape_string($db, filter_var($_POST['email'], FILTER_VALIDATE_EMAIL));
        $password = mysqli_real_escape_string($db, $_POST['password']);

        if(!$email) {
            $erreurs[] = 'Email Obligatoire';
        }
        if(!$password) {
            $erreurs[] = 'Mot de Passe Obligatoire';
        }

        if(empty($erreurs)) {
            // Verification de l'existence d'utilisateur
            $query = "SELECT * FROM vendeurs WHERE email = '{$email}' ";
            $resultat = mysqli_query($db, $query);

            if( $resultat->num_rows ) {
                // Verification de mot de passe
                $utilisateur = mysqli_fetch_assoc($resultat);
                
                // var_dump($utilisateur['password']);

                // Mot de passe correct ou pas
                $auth = password_verify($password, $utilisateur['password']);
                
                if($auth) {
                    // L'utilisateur identifié
                    session_start();

                    // Réemplir l'array 
                    $_SESSION['utilisateur'] = $utilisateur['email'];
                    $_SESSION['login'] = true;
                    $_SESSION['rol'] = $utilisateur['rol'];

                    if (isset($utilisateur['rol'])) {
                        if ($utilisateur['rol'] === 'employer') {
                            header('Location: /admin/after_login.php'); // Redireccionar si es empleado
                            } elseif ($utilisateur['rol'] === 'administrateur') {
                            header('Location: /admin/propietaire/administrateur.php'); // Redireccionar si es administrador
                            }
                            } else {
                            $erreurs[] = "Le rôle de l'utilisateur n'est pas défini";
                            }
                            } else {
                            $erreurs[] = 'Mot de passe incorrect';
                            }

                            }else {
                            $erreurs[] = "Utilisateur non existent";
                            }
        }
    }
    

    /** Header */
    require 'includes/functions.php';
    incluTemplates('header');
?>
<h2 class="admin-section-text">Page uniquement disponible sur ordinateur !</h2>
<main class="container section formulaire-centre admin-section">
    <h1>Se Connecter</h1>

   <div class="formulaire-grid">
        <div>
            <?php foreach($erreurs as $erreur): ?>
                <div class="alerte erreur">
                    <?php echo $erreur; ?>
                </div>

            <?php endforeach; ?>

            <form method="POST" class="formulaire" novalidate>
                <fieldset>
                    <legend>Email et Password</legend>

                    <label for="email">E-mail</label>
                    <input type="email" name="email" placeholder="Votre Email" id="email">

                    <label for="password">Mot de Passe</label>
                    <input type="password" name="password" placeholder="Votre Mot de Passe" id="password">
                </fieldset>
                <input type="submit" class="btn-green" value="connexion">
            </form>
        </div>

   </div>

</main>

<!-- Footer -->
<?php 
    incluTemplates('footer'); 
?>
