document.addEventListener("DOMContentLoaded", function() {
    // Eenvoudige form validatie voorbeeld
    const contactForm = document.querySelector("form");
    if (contactForm) {
        contactForm.addEventListener("submit", function(e) {
            const naam = document.getElementById("naam").value;
            const email = document.getElementById("email").value;
            const bericht = document.getElementById("bericht").value;
            if (!naam || !email || !bericht) {
                e.preventDefault(); // Voorkom het versturen van het formulier
                alert("Vul alstublieft alle velden in.");
            }
            // Verdere validatie of AJAX-verzoek kan hier worden toegevoegd
        });
    }
});


window.addEventListener('scroll', function() {
    var footer = document.querySelector('footer');
    var scrollPosition = window.scrollY;
    var windowHeight = window.innerHeight;
    var bodyHeight = document.body.offsetHeight;
    var footerHeight = footer.offsetHeight;

    // Bereken het percentage van de pagina dat is gescrolld
    var scrollPercentage = (scrollPosition + windowHeight) / bodyHeight * 100;

    // Toon de footer wanneer de scrollPercentage hoger is dan 90%
    if (scrollPercentage >= 99 || bodyHeight <= windowHeight) {
        footer.style.display = 'block';
    } else {
        footer.style.display = 'none';
    }
});






document.getElementById("zoekFormulier").addEventListener("submit", function(event) {
    event.preventDefault(); // Voorkom standaardformulierinzending

    // Haal de zoekterm op uit het invoerveld
    var zoekterm = document.getElementById("zoekInput").value.toLowerCase();

    // Haal de klantgegevens op via AJAX
    var xhr = new XMLHttpRequest();
    xhr.open("GET", "get_klanten.php", true);
    xhr.onload = function() {
        if (xhr.status === 200) {
            // JSON-parse de ontvangen gegevens
            var result = JSON.parse(xhr.responseText);

            // Loop door elke klant en voer de zoekfunctie uit
            var gevondenKlanten = [];
            result.forEach(function(data) {
                var klantNaam = data.Naam.toLowerCase();
                var klantEmail = data.Email.toLowerCase();
                var klantTelefoon = data.Telefoonnummer.toLowerCase();
                var klantAdres = data.Adres.toLowerCase();

                if (klantNaam.includes(zoekterm) || klantEmail.includes(zoekterm) || klantTelefoon.includes(zoekterm) || klantAdres.includes(zoekterm)) {
                    // Voeg de gevonden klant toe aan het array
                    gevondenKlanten.push(data.Naam);

                    // Scroll naar de gevonden klant
                    var klantElement = document.getElementById("klant_" + data.Naam);
                    klantElement.scrollIntoView({ behavior: "smooth" });

                    // Geef de gevonden klant een andere kleur
                    klantElement.style.backgroundColor = "lightgreen";
                }
            });

            // Toon de gevonden klanten in een popup-venster
            if (gevondenKlanten.length > 0) {
                alert("Gevonden klanten:\n" + gevondenKlanten.join("\n"));
            } else {
                alert("Geen klanten gevonden met de opgegeven zoekterm.");
            }
        } else {
            alert("Er is een fout opgetreden bij het ophalen van de klantgegevens.");
        }
    };
    xhr.send();

    // Reset het zoekveld
    
    }

);


document.getElementById("zoekFormulier").addEventListener("submit", function(event) {
    event.preventDefault(); // Voorkom standaardformulierinzending

    // Haal de zoekterm op uit het invoerveld
    var zoekterm = document.getElementById("zoek").value.toLowerCase();

    // Haal alle producten op
    var producten = document.querySelectorAll(".product");

    // Array om gevonden productnamen op te slaan
    var gevondenProducten = [];

    // Loop door elk product om te controleren op overeenkomsten met de zoekterm
    producten.forEach(function(product) {
        var productNaam = product.querySelector("h1").innerText.toLowerCase();
        var productBeschrijving = product.querySelector(".Beschrijving").innerText.toLowerCase();
        var productPrijs = product.querySelector("h1").innerText.toLowerCase();

        if (productNaam.includes(zoekterm) || productBeschrijving.includes(zoekterm) || productPrijs.includes(zoekterm)) {
            // Scroll naar het gevonden product
            product.scrollIntoView({ behavior: "smooth" });

            // Verander de achtergrondkleur van het gevonden product
            product.style.backgroundColor = "lightgreen";

            // Voeg de naam van het gevonden product toe aan de array
            gevondenProducten.push(productNaam);
        }
    });

    // Toon de gevonden producten in een popup-venster
    if (gevondenProducten.length > 0) {
        alert("Gevonden producten:\n" + gevondenProducten.join("\n"));
    } else {
        alert("Geen producten gevonden met de opgegeven zoekterm.");
    }

    
    // Laad de pagina opnieuw

    
});



