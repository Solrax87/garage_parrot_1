<?php 

    require 'includes/functions.php';

    incluTemplates('header');

    

?>

<section class="container container-section">
        <h1>Véhicules d'occasion</h1>

            <!-- Formulaire filtre par voiture -->
            <form id="filtre" class="filtre-form">
                <div class="filtre-item">
                    <label for="prix">Prix</label>
                    <div class="range-container">
                        <input type="range" id="prix" name="prix" min="0" max="150000" value="0">
                        <span id="prix-min-value">0</span>
                        <span>/</span>
                        <span id="prix-max-value">150000</span>
                    </div>
                </div>

                <div class="filtre-item">
                    <label for="kilometrage">Kilométrage</label>
                    <div class="range-container">
                        <input type="range" id="kilometrage" name="kilometrage" min="0" max="250000" value="0">
                        <span id="kilometrage-min-value">0</span>
                        <span>/</span>
                        <span id="kilometrage-max-value">250000</span>
                    </div>
                </div>

                <div class="filtre-item">
                    <label for="annees">Années</label>
                    <div class="range-container">
                        <input type="range" id="annees" name="annees" min="2001" max="2025" value="2001">
                        <span id="annees-min-value">2001</span>
                        <span>/</span>
                        <span id="annees-max-value">2025</span>
                    </div>
                </div>
                <div class="btns">
                    <button type="submit" class="btn-green">Filtrer</button>
                    <a href="vehicules.php" type="submit" id="reset-btn" class="btn-red">Resset</a>
                </div>
                
            </form>



    <!-- Contenedor para mostrar los vehículos filtrados -->
    <div id="vehiculesContainer" class="vehicules-container">

        <?php  $limite = 12; include 'includes/templates/vehicules.php'; ?>
    </div>


</section>
<!-- Footer -->
<?php 
        incluTemplates('footer'); 
?>
