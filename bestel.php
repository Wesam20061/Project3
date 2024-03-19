<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['klantID']) && !empty($_SESSION['winkelwagen'])) {
    $klantID = $_POST['klantID'];

    try {
        $db = new PDO("mysql:host=localhost;dbname=webshop top scoot", "root", "");
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Start een database transactie
        $db->beginTransaction();

        // Maak een nieuwe bestelling aan
        $bestellingQuery = $db->prepare("INSERT INTO bestellingen (klantID, BestelDatum) VALUES (:klantID, NOW())");
        $bestellingQuery->execute([':klantID' => $klantID]);
        $bestellingID = $db->lastInsertId();

        // Voorbereiden van de query om product details op te halen
        $productDetailsQuery = $db->prepare("SELECT Prijs FROM producten WHERE ProductID = :productID");

        // Voorbereiden van de query om producten toe te voegen aan de bestelling
        $productInsertQuery = $db->prepare("INSERT INTO bestelling_producten (BestellingID, ProductID, Aantal, PrijsPerStuk) VALUES (:bestellingID, :productID, 1, :prijsPerStuk)");

        foreach ($_SESSION['winkelwagen'] as $productID) {
            // Haal de huidige prijs van het product op
            $productDetailsQuery->execute([':productID' => $productID]);
            $product = $productDetailsQuery->fetch(PDO::FETCH_ASSOC);

            // Voeg het product toe aan de bestelling met de huidige prijs
            $productInsertQuery->execute([
                ':bestellingID' => $bestellingID, 
                ':productID' => $productID, 
                ':prijsPerStuk' => $product['Prijs']
            ]);
        }

        // Commit de transactie
        $db->commit();

        // Leeg de winkelwagen sessie
        unset($_SESSION['winkelwagen']);

        // Redirect naar een bevestigingspagina
        header("Location: index.php"); // Zorg dat deze pagina bestaat
        exit();

    } catch (PDOException $e) {
        // Bij een fout, rollback de transactie
        $db->rollBack();
        die("Error!: " . $e->getMessage());
    }
} else {
    header("Location: winkelwagen.php");
    exit();
}
?>
