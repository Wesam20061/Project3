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