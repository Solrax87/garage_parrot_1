document.addEventListener("DOMContentLoaded", function() {
    // Función para restablecer el filtro de coches
    function resetCarFilter() {
        // Restablecer los valores de los controles deslizantes y los valores mostrados
        const rangeInputs = document.querySelectorAll("input[type=range]");
        rangeInputs.forEach(function(input) {
            const output = input.parentElement.querySelector("span");
            input.value = input.getAttribute("value");
            output.textContent = input.value;
        });
    }

    // Obtener el botón de restablecimiento y agregar un evento de clic
    const resetBtn = document.getElementById("reset-btn");
    resetBtn.addEventListener("click", resetCarFilter);
});

document.addEventListener("DOMContentLoaded", function() {
    const form = document.getElementById("filtre");

    // Función para obtener el precio anterior del almacenamiento local
    function getPreviousPrice() {
        return localStorage.getItem("previousPrice") || "0";
    }

    // Función para establecer el precio anterior en el almacenamiento local
    function setPreviousPrice(price) {
        localStorage.setItem("previousPrice", price);
    }

    // Establecer el valor inicial del rango de precio
    const prixInput = document.getElementById("prix");
    prixInput.value = getPreviousPrice();
    updatePriceLabels(prixInput);

    form.addEventListener("submit", function(event) {
        event.preventDefault();

        const minPrice = prixInput.value;
        const maxPrice = document.getElementById("prix-max-value").textContent;
        const minKilometrage = document.getElementById("kilometrage-min-value").textContent;
        const maxKilometrage = document.getElementById("kilometrage-max-value").textContent;
        const minAnnees = document.getElementById("annees-min-value").textContent;
        const maxAnnees = document.getElementById("annees-max-value").textContent;

        const xhr = new XMLHttpRequest();
        xhr.open("GET", `vehicules_partial.php?prix_min=${minPrice}&prix_max=${maxPrice}&kilometrage_min=${minKilometrage}&kilometrage_max=${maxKilometrage}&annees_min=${minAnnees}&annees_max=${maxAnnees}`, true);
        xhr.onload = function() {
            if (xhr.status === 200) {
                document.querySelector("#vehiculesContainer").innerHTML = xhr.responseText;
                // Guardar el precio actual en el almacenamiento local
                setPreviousPrice(minPrice);
            }
        };
        xhr.send();

        // Agregar nuevamente el event listener al botón "Filtrer"
        const submitBtn = document.querySelector(".btn-green");
        submitBtn.addEventListener("click", submitForm);
    });

    // Función para enviar el formulario
    function submitForm() {
        form.submit();
    }

    // Evento de clic en el botón de restablecimiento
    const resetBtn = document.getElementById("reset-btn");
    resetBtn.addEventListener("click", function() {
        // Restablecer los valores de los controles deslizantes y los valores mostrados
        const rangeInputs = document.querySelectorAll("input[type=range]");
        rangeInputs.forEach(function(input) {
            const output = input.parentElement.querySelector("span");
            input.value = input.getAttribute("value");
            output.textContent = input.value;
        });
    });

    // Evento de cambio en los controles deslizantes
    const rangeInputs = document.querySelectorAll("input[type=range]");
    rangeInputs.forEach(function(input) {
        input.addEventListener("input", function() {
            const output = this.parentElement.querySelector("span");
            output.textContent = this.value;
        });
    });

    // Función para actualizar los valores de los labels de precio
    function updatePriceLabels(input) {
        const minPriceLabel = document.getElementById("prix-min-value");
        const maxPriceLabel = document.getElementById("prix-max-value");
        minPriceLabel.textContent = input.value;
        maxPriceLabel.textContent = input.max;
    }
    
    // Actualizar los valores de los labels de precio cuando cambia el rango de precio
    prixInput.addEventListener("input", function() {
        updatePriceLabels(this);
    });
});



/* Compteur des mots */ 

function maxLength(el) {	
    if (!('maxLength' in el)) {
        var max = el.attributes.maxLength.value;
        el.onkeypress = function () {
            if (this.value.length >= max) return false;
        };
    }
}

maxLength(document.getElementById("comentaire"));

/** Allert buton témoignage */

function confirmation() {
    var reponse = confirm('Souhaitez-vous envoyer les informations ?');
    if(reponse == true) {
        return true;
    } else {
        return false;
    }
}

function confirmation2() {
    var reponse = confirm('Êtes-vous sûr de vouloir supprimer les informations ?');
    if(reponse == true) {
        return true;
    } else {
        return false;
    }
}
