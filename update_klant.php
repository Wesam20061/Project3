<?php
    // Controleer of het formulier is ingediend
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Controleer of alle vereiste velden zijn ingevuld
        if (isset($_POST['klantID']) && isset($_POST['naam']) && isset($_POST['email']) && isset($_POST['telefoonnummer']) && isset($_POST['adres'])) {
            $klantID = $_POST['klantID'];
            $naam = $_POST['naam'];
            $email = $_POST['email'];
            $telefoonnummer = $_POST['telefoonnummer'];
            $adres = $_POST['adres'];

            try {
                // Maak verbinding met de database
                $db = new PDO("mysql:host=localhost;dbname=webshop top scoot", "root", "");
                
                // Bereid de update query voor
                $query = $db->prepare("UPDATE `klanten` SET Naam = :naam, Email = :email, Telefoonnummer = :telefoonnummer, Adres = :adres WHERE KlantID = :klantID");
                $query->bindParam(':klantID', $klantID);
                $query->bindParam(':naam', $naam);
                $query->bindParam(':email', $email);
                $query->bindParam(':telefoonnummer', $telefoonnummer);
                $query->bindParam(':adres', $adres);

                // Voer de update query uit
                $query->execute();

                // Stuur de gebruiker terug naar de lijst met klanten
                header("Location: klanten.php");
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