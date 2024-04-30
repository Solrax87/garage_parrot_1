<?php 

    require 'includes/functions.php';

    incluTemplates('header');

?>


<section class="container section">

    <h1>CONTACT</h1>

        <picture>
            <img 
                loading="lazy" 
                src="img/contact/contact_1.jpeg" 
                alt="Imagen Contacto">
        </picture>

        <form 
            class="formulaire" 
            action="https://formspree.io/f/mrgnlrvg" 
            method="POST">
            <fieldset>
                <legend>Informations Personnelles</legend>

                <label for="nom">Nom et Prénom</label>
                <input type="text" id="nom" name="nom">

                <label for="email">E-mail</label>
                <input type="email" placeholder="Tu Email" id="email" name="email">

                <label for="telefono">Teléfono</label>
                <input type="tel" placeholder="Tu Teléfono" id="telefono" name="telefono">

                <label for="service">Sérvice</label>
                <select id="service" name="service">
                    <option value="" disabled selected>-- Choisissez une option --</option>
                    <option value="1">Achat de véhicules</option>
                    <option value="2">Location de voiture</option>
                    <option value="3">Nettoyage de voiture</option>
                </select> 

                <label for="mensaje">Mensaje:</label>
                <textarea id="mensaje" name="mensaje"></textarea>
            </fieldset>

            <fieldset>
                <legend>Comment souhaitez-vous être contacté ?</legend>

                <div class="radio">
                    <label for="contact-phone">Téléphone</label>
                    <input name="contact-phone" type="radio" value="telephone" id="contact-phone">

                    <label for="contact-email">E-mail</label>
                    <input name="contact-email" type="radio" value="email" id="contact-email">
                </div>

                <p class="option-date">Si vous avez choisi le téléphone, veuillez choisir la date et l'heure</p>

                <label for="date">Date :</label>
                <input type="date" id="date" name="date">

                <label for="heure">Heure :</label>
                <input type="time" id="heure" min="09:00" max="18:00" name="heure">

                <input type="submit" value="Envoyer" class="btn-green">
            </fieldset>

        </form> 
</section>




<!-- Footer -->
<?php 
        incluTemplates('footer'); 
    ?>
