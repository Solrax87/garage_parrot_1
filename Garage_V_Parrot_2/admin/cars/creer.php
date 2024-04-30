<?php 
    require '../../includes/functions.php';
    $auth = authentifie();

    if(!$auth) {
        header('Location: /index.php');
    }

    //Base de donne (connexion)
    require '../../includes/config/database.php';
    $db = conectBD();

    // Consultation pour l'optention de vendeurs
    $consultation = "SELECT * FROM vendeurs";
    $resultat = mysqli_query($db, $consultation);

    // Array message erreur
    $erreures = [];

    $titre = '';
    $prix = '';
    $kilometrage = '';
    $date_circulation = '';
    $option1 = '';
    $marque = '';
    $modele = '';
    $boite = '';
    $couleur = '';
    $puissance = '';
    $sellerie = '';
    $type1 = '';
    $version1 = '';
    $energie = '';
    $vendeurs_id = '';

    //Execute le code aprés que l'utilisateur envoi le formulaire
    if($_SERVER['REQUEST_METHOD'] === 'POST') {

        //  echo"<pre>";
        //  var_dump($_POST);
        //  echo"</pre>";

        //  echo"<pre>";
        //  var_dump($_FILES);
        //  echo"</pre>";

         
        // Assainir
        $titre = mysqli_real_escape_string($db, $_POST['titre']);
        $prix = mysqli_real_escape_string($db, $_POST['prix']);
        $kilometrage = mysqli_real_escape_string($db, $_POST['kilometrage']);
        $date_circulation = mysqli_real_escape_string($db, $_POST['date_circulation']);
        $option1 = mysqli_real_escape_string($db, $_POST['option1']);
        $marque = mysqli_real_escape_string($db, $_POST['marque']);
        $modele = mysqli_real_escape_string($db, $_POST['modele']);
        $boite = mysqli_real_escape_string($db, $_POST['boite']);
        $couleur = mysqli_real_escape_string($db, $_POST['couleur']);
        $puissance = mysqli_real_escape_string($db, $_POST['puissance']);
        $sellerie = mysqli_real_escape_string($db, $_POST['sellerie']);
        $type1 = mysqli_real_escape_string($db, $_POST['type1']);
        $version1 = mysqli_real_escape_string($db, $_POST['version1']);
        $energie = mysqli_real_escape_string($db, $_POST['energie']);
        $vendeurs_id = mysqli_real_escape_string($db, $_POST['vendeur']);
        $date_creation = date('Y/m/d');

        // Files ver une variable
        $image1 = $_FILES['image1'];
        $image2 = $_FILES['image2'];
        $image3 = $_FILES['image3'];
        $image4 = $_FILES['image4'];
    
        // Message d'erreur
        if(!$titre) {
            $erreures[] = "Vous devez ajouter un Titre";
        }

        if(!$prix) {
            $erreures[] = "Le Prix c'est obligatoir";
        }

        if(!$kilometrage) {
            $erreures[] = "Le Kilomètrage c'est obligatoir";
        }

        if(!$date_circulation) {
            $erreures[] = "La Date de Circulation est obligatoire";
        }

        if( strlen ($option1) < 30 ) {
            $erreures[] = "Les Options sonst obligatoires. Ex. Extérieur, Intérieur et Confort, Sécurité ";
        }

        if(!$marque) {
            $erreures[] = "La Marque c'est obligatoire";
        }

        if(!$modele) {
            $erreures[] = "Le Modèle c'est obligatoire";
        }

        if(!$boite) {
            $erreures[] = "Le Type de Boite de Vitesse c'est obligatoire";
        }

        if(!$couleur) {
            $erreures[] = "La Couleur de vehicule c'est obligatoire";
        }

        if(!$puissance) {
            $erreures[] = "Le Chevaux Vapeur sont obligatoir";
        }

        if(!$sellerie) {
            $erreures[] = "La Sellerie c'est obligatoire";
        }

        if(!$type1) {
            $erreures[] = "La Type de vehicule c'est obligatoire";
        }

        if(!$version1) {
            $erreures[] = "La Version de vehicule c'est obligatoire";
        }
        if(!$energie) {
            $erreures[] = "Le Type d'Energie c'est Obligatoire";
        }

        if(!$vendeurs_id) {
            $erreures[] = "Choisissez un vendeur";
        }

        if(!$image1['name'] || $image1['error'] ) {
            $erreures[] = 'Image en .jpg ou .png obligatoire';
        }

        if(!$image2['name'] || $image2['error'] ) {
            $erreures[] = 'Image en .jpg ou .png obligatoire';
        }

        if(!$image3['name'] || $image3['error'] ) {
            $erreures[] = 'Image en .jpg ou .png obligatoire';
        }

        if(!$image4['name'] || $image4['error'] ) {
            $erreures[] = 'Image en .jpg ou .png obligatoire';
        }

        // Validation par mesure (1mb max)
        $mesure = 1000 * 1000;

        if($image1['size'] > $mesure ) {
            $erreures[] = 'Image très lourde';
        }
        if($image2['size'] > $mesure ) {
            $erreures[] = 'Image très lourde';
        }
        if($image3['size'] > $mesure ) {
            $erreures[] = 'Image très lourde';
        }
        if($image4['size'] > $mesure ) {
            $erreures[] = 'Image très lourde';
        }

        // echo"<pre>";
        // var_dump($erreures);
        // echo"</pre>";

        //Verfication que l'array soit vide
        if(empty($erreures)) {

            /** Upload de fichier */

            // Creation de chemise
            $chemiseImages = '../../images/';

            if(!is_dir($chemiseImages)) {
                mkdir($chemiseImages); 
            }

            // Nom unique
            $nomImage = md5( uniqid( rand(), true ) ) . ".jpg";
            $nomImage2 = md5( uniqid( rand(), true ) ) . ".jpg";
            $nomImage3 = md5( uniqid( rand(), true ) ) . ".jpg";
            $nomImage4 = md5( uniqid( rand(), true ) ) . ".jpg";

            // Upload l'image
            move_uploaded_file($image1['tmp_name'], $chemiseImages . $nomImage) ;
            move_uploaded_file($image2['tmp_name'], $chemiseImages . $nomImage2) ;
            move_uploaded_file($image3['tmp_name'], $chemiseImages . $nomImage3) ;
            move_uploaded_file($image4['tmp_name'], $chemiseImages . $nomImage4) ;
         
            //Insertion dans la BD
        $query = "INSERT INTO vehicules (titre, prix, kilometrage, date_circulation, image1, image2, image3, image4, option1, marque, modele, boite, couleur, puissance, sellerie, type1, version1, energie, date_creation, vendeurs_id ) VALUES ('$titre', '$prix', '$kilometrage', '$date_circulation', '$nomImage', '$nomImage2', '$nomImage3', '$nomImage4', '$option1', '$marque', '$modele', '$boite', '$couleur', '$puissance', '$sellerie', '$type1', '$version1', '$energie', '$date_creation', '$vendeurs_id' )";

        $resultat = mysqli_query($db, $query);

        if($resultat) {

            // Redirection d'utilisateur
            header('Location: /admin?enregistrement=1');
            }
        }
    }


    // Header

    incluTemplates('header');

?>

<main class="container section">
    <h1>Créer</h1>

    <a href="/admin/" class="btn-green">Revenir</a>

    <?php foreach($erreures as $erreur): ?>
        <div class="alerte erreur">
            <?php echo $erreur; ?>
        </div>
        
    <?php endforeach; ?>

    <form 
        class="formulaire" 
        method="POST" 
        action="/admin/cars/creer.php" 
        enctype="multipart/form-data" >

        <fieldset>
            <legend>Information Générale</legend>

            <label for="titre">Titre :</label>
            <input 
            type="text" 
            id="titre" 
            name="titre" 
            placeholder="Titre Voiture" 
            value="<?php echo $titre; ?>">

            <label for="prix">Prix :</label>
            <input 
            type="number" 
            id="prix" 
            name="prix" 
            placeholder="Prix Voiture" 
            value="<?php echo $prix; ?>">

            
            <label for="kilometrage">Kilomètrage</label>
            <input 
            type="number" 
            id="kilometrage" 
            name="kilometrage" 
            placeholder="Kilomètres Parcourus" 
            min="1" 
            value="<?php echo $kilometrage; ?>">
            
            <label for="date_circulation">Mise en Circulation</label>
            <input 
            type="date" 
            id="date_circulation" 
            name="date_circulation" 
            placeholder="Mise en Circulation de la Voiture"
            value="<?php echo $date_circulation; ?>">
            
            <!-- Espace pour les images -->

            <!-- image principale -->
            <label for="image1">Image Préséntation :</label>
            <input 
            type="file" 
            id="image1" 
            name="image1" 
            accept="image/jpeg, image/png" >

            <!-- Images pour la galérie -->
            <label for="image2">Image :</label>
            <input 
            type="file" 
            id="image2" 
            name="image2" 
            accept="image/jpeg, image/png" >

            <label for="image3">Image :</label>
            <input 
            type="file" 
            id="image3" 
            name="image3" 
            accept="image/jpeg, image/png" >

            <label for="image4">Image :</label>
            <input 
            type="file" 
            id="image4" 
            name="image4" 
            accept="image/jpeg, image/png" >

            <!-- Fin d'espace images -->

            <label for="option1">Options Véhicule :</label>
            <textarea 
            id="option1" 
            name="option1" 
            min="60"><?php echo $option1; ?></textarea>
        </fieldset>

        <fieldset>
            <legend>Fiche Technique</legend>

            <label for="marque">Marque :</label>
            <input 
            type="text" 
            id="marque" 
            name="marque" 
            placeholder="Marque Voiture" 
            value="<?php echo $marque; ?>">

            <label for="modele">Modèle :</label>
            <input 
            type="text" 
            id="modele" 
            name="modele" 
            placeholder="Modèle Voiture" 
            value="<?php echo $modele; ?>">

            <label for="boite">Boite de vitesse :</label>
            <input 
            type="text" 
            id="boite" 
            name="boite" 
            placeholder="Boite de Vitesse" 
            value="<?php echo $boite; ?>">

            <label for="couleur">Couleur :</label>
            <input 
            type="text" 
            id="couleur" 
            name="couleur" 
            placeholder="Couleur Voiture" 
            value="<?php echo $couleur; ?>">

            <label for="puissance">Puissance Moteur (en chevaux) :</label>
            <input 
            type="number" 
            id="puissance" 
            name="puissance" 
            placeholder="Chevaux Vapeur" 
            min="1" 
            value="<?php echo $puissance; ?>">

            <label for="sellerie">Sellerie :</label>
            <input 
            type="text" 
            id="sellerie" 
            name="sellerie" 
            placeholder="Sellerie Interieur Vaoiture" 
            value="<?php echo $sellerie; ?>">

            <label for="type1"> Type de Véhicule :</label>
            <input 
            type="text" 
            id="type1" 
            name="type1" 
            placeholder="Type de Véhicule" 
            value="<?php echo $type1; ?>">

            <label for="version1"> Version :</label>
            <input 
            type="text" 
            id="version1" 
            name="version1" 
            placeholder="Version de Véhicule" 
            value="<?php echo $version1; ?>">

            <label for="energie"> Energie :</label>
            <input 
            type="text" 
            id="energie" 
            name="energie" 
            placeholder="Type de carburant" 
            value="<?php echo $energie; ?>">
            
        </fieldset>

        <fieldset>
            <legend>Vendeur</legend>

            <!-- Vendeurs liés avec la BD "vendeurs" et son "id" -->
            <select name="vendeur" value="<?php echo $vendeur; ?>">
                <option value="">-- Sélectionner --</option>
                <?php while($vendeur = mysqli_fetch_assoc($resultat) ) : ?>
                    <option 
                    <?php echo $vendeurs_id === $vendeur['id'] ? 'selected' : ''; ?>
                    value="<?php echo $vendeur['id']; ?>"> 
                    <?php echo $vendeur['nom'] . " " . $vendeur['prenom']; ?> 
                </option>
                <?php endwhile; ?>
            </select>

        </fieldset>

        <input type="submit" value="Créer" class="btn-green">

    </form>

</main>




<!-- Footer -->
<?php 
        incluTemplates('footer'); 
    ?>
