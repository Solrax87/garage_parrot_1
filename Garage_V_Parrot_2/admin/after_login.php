<?php 
    require '../includes/functions.php';
    $auth = authentifie();

    if(!$auth) {
        header('Location: /login.php');
        exit;
    }

    
    /* Header */
    incluTemplates('header');
?>

<section>
    <h1>Administrateur de Services</h1>

    <div class="btn-admin container">

        <div>
            <a class="btn-green" href="/admin">ADMIN VÉHICULES</a>
        </div>
        <div>
            <a class="btn-green" href="/admin/temoignages/temoignages.php"> Admin Temoignages</a>
        </div>

    </div>
</section>




<!-- Footer -->
<?php 
    incluTemplates('footer'); 
?>
