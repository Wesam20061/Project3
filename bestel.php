<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Controleer of de vereiste velden zijn ingestuurd
    if (isset($_POST['klantID']) && isset($_POST['productIDs'])) {
        // Maak verbinding met de database
        try {
            $db = new PDO("mysql:host=localhost;dbname=webshop top scoot", "root", "");
            $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            
            // Voorbereiden van de query om bestelling in te voegen
            $insertQuery = $db->prepare("INSERT INTO bestellingen (productID, klantID, BestelDatum, aantal) VALUES (:productID, :klantID, CURDATE(), 1)");
            
            // Haal de klantID op uit het formulier
            $klantID = $_POST['klantID'];
            
            // Haal de productID's op uit het verborgen veld en splits ze in een array
            $productIDs = explode(",", $_POST['productIDs']);
            
            // Loop door de productID's en voeg elke bestelling toe aan de database
            foreach ($productIDs as $productID) {
                // Voeg de bestelling toe aan de database
                $insertQuery->bindParam(':productID', $productID);
                $insertQuery->bindParam(':klantID', $klantID);
                $insertQuery->execute();
            }
            
            // Verwijder de winkelwagen sessie na het plaatsen van de bestelling
            unset($_SESSION['winkelwagen']);
            
            // Redirect naar een bedankpagina of een andere pagina
            header("Location: index.php");
            exit();
            
        } catch (PDOException $e) {
            die("Error!: " . $e->getMessage());
        }
    } else {
        // Als vereiste velden ontbreken, geef een foutmelding weer
        echo "Niet alle vereiste velden zijn ingevuld.";
    }
} else {
    // Als het geen POST-verzoek is, stuur de gebruiker terug naar de winkelwagenpagina
    header("Location: winkelwagen.php");
    exit();
}
?>
