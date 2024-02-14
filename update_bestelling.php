<?php
// Controleer of het formulier is ingediend
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Controleer of alle vereiste velden zijn ingevuld
    if (isset($_POST['bestellingID']) && isset($_POST['totalePrijs']) && isset($_POST['status'])) {
        $bestellingID = $_POST['bestellingID'];
        $totalePrijs = $_POST['totalePrijs'];
        $status = $_POST['status'];

        try {
            // Maak verbinding met de database
            $db = new PDO("mysql:host=localhost;dbname=webshop top scoot", "root", "");
            
            // Bereid de update query voor
            $query = $db->prepare("UPDATE `bestellingen` SET TotalePrijs = :totalePrijs, Status = :status WHERE BestellingID = :bestellingID");
            $query->bindParam(':bestellingID', $bestellingID);
            $query->bindParam(':totalePrijs', $totalePrijs);
            $query->bindParam(':status', $status);

            // Voer de update query uit
            $query->execute();

            // Stuur de gebruiker terug naar de lijst met bestellingen
            header("Location: bestellingen.php");
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
