<?php
    // Controleer of het formulier is ingediend
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Controleer of alle vereiste velden zijn ingevuld
        if (isset($_POST['productID']) && isset($_POST['naam']) && isset($_POST['afbeeldingURL']) && isset($_POST['beschrijving']) && isset($_POST['prijs'])) {
            $productID = $_POST['productID'];
            $naam = $_POST['naam'];
            $afbeeldingURL = $_POST['afbeeldingURL'];
            $beschrijving = $_POST['beschrijving'];
            $prijs = $_POST['prijs'];

            try {
                // Maak verbinding met de database
                $db = new PDO("mysql:host=localhost;dbname=webshop top scoot", "root", "");
                
                // Bereid de update query voor
                $query = $db->prepare("UPDATE `producten` SET Naam = :naam, AfbeeldingURL = :afbeeldingURL, Beschrijving = :beschrijving, Prijs = :prijs WHERE ProductID = :productID");
                $query->bindParam(':productID', $productID);
                $query->bindParam(':naam', $naam);
                $query->bindParam(':afbeeldingURL', $afbeeldingURL);
                $query->bindParam(':beschrijving', $beschrijving);
                $query->bindParam(':prijs', $prijs);

                // Voer de update query uit
                $query->execute();

                // Stuur de gebruiker terug naar de lijst met producten
                header("Location: producten.php");
                exit();
            } catch(PDOException $e) {
                die("Error!: " . $e->getMessage());
            }
        } else {
            // Als niet alle vereiste velden zijn ingevuld, geef een foutmelding weer
            echo "Niet alle vereiste velden zijn ingevuld.";
        }
    } else {
        // Als het formulier niet is ingediend via de juiste methode, geef een foutmelding weer
        echo "Formulier is niet verzonden via POST-methode.";
    }
?>