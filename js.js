// Luister naar het DOMContentLoaded-event om te wachten tot de inhoud van de pagina is geladen voordat we interactie toevoegen
document.addEventListener("DOMContentLoaded", function() {
    // Eenvoudige formuliervalidatievoorbeeld
    const contactForm = document.querySelector("form");
    if (contactForm) {
        contactForm.addEventListener("submit", function(e) {
            const naam = document.getElementById("naam").value;
            const email = document.getElementById("email").value;
            const bericht = document.getElementById("bericht").value;
            if (!naam || !email || !bericht) {
                e.preventDefault(); // Voorkom het verzenden van het formulier
                alert("Vul alstublieft alle velden in.");
            }
            // Verdere validatie of AJAX-verzoek kan hier worden toegevoegd
        });
    }
});

// Luister naar het scroll-event om de footer te tonen of te verbergen afhankelijk van de schermpositie
window.addEventListener('scroll', function() {
    var footer = document.querySelector('footer');
    var scrollPosition = window.scrollY;
    var windowHeight = window.innerHeight;
    var bodyHeight = document.body.offsetHeight;
    var footerHeight = footer.offsetHeight;

    // Bereken het percentage van de pagina dat is gescrolld
    var scrollPercentage = (scrollPosition + windowHeight) / bodyHeight * 100;

    // Toon de footer wanneer de scrollPercentage hoger is dan 99% of wanneer de pagina kleiner is dan het venster
    if (scrollPercentage >= 99 || bodyHeight <= windowHeight) {
        footer.style.display = 'block';
    } else {
        footer.style.display = 'none';
    }
});


        document.getElementById("loginForm").addEventListener("submit", function(event) {
            event.preventDefault(); // Voorkom standaardformulierinzending

            // Haal gebruikersnaam en wachtwoord op
            var username = document.getElementById("username").value;
            var password = document.getElementById("password").value;

            // Simpele inlogvalidatie (vervang dit met je eigen validatielogica)
            if (username === "admin" && password === "klant") {
                // Redirect naar de andere pagina als inloggegevens correct zijn
                window.location.href = "klanten.php";
            } else {
                alert("Ongeldige inloggegevens. Probeer opnieuw.");
            }
        });
    
