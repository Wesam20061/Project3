<?php
session_start();

// Controleer of er producten in de winkelwagen zitten
if(isset($_SESSION['winkelwagen']) && !empty($_SESSION['winkelwagen'])) {
    try {
        // Maak verbinding met de database
        $db = new PDO("mysql:host=localhost;dbname=webshop top scoot", "root", "");
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Begin een transactie
        $db->beginTransaction();

        // Bestel datum instellen
        $bestelDatum = date('Y-m-d H:i:s');

        // Voorbereiden van de query om een bestelling toe te voegen
        $insertOrderQuery = $db->prepare("INSERT INTO `bestellingen` (`ProductID`, `Aantal`, `BestelDatum`) VALUES (:productID, :aantal, :bestelDatum)");

        // Loop door elk product in de winkelwagen
        foreach ($_SESSION['winkelwagen'] as $productID) {
            // Voeg het product toe aan de bestelling
            $insertOrderQuery->bindParam(':productID', $productID);
            $aantal = 0; // Initialiseer het aantal op 0
            // Verhoog het aantal voor elk voorkomen van het product in de winkelwagen
            foreach ($_SESSION['winkelwagen'] as $item) {
                if ($item === $productID) {
                    $aantal++;
                }
            }
            $insertOrderQuery->bindParam(':aantal', $aantal);
            $insertOrderQuery->bindParam(':bestelDatum', $bestelDatum);
            $insertOrderQuery->execute();
        }

        // Commit de transactie
        $db->commit();

        // Leeg de winkelwagen
        $_SESSION['winkelwagen'] = array();

        // Success message instellen
        $_SESSION['success_message'] = "Producten succesvol besteld!";

        // Doorsturen naar de index pagina
        header("Location: index.php");
        exit();
    } catch(PDOException $e) {
        // Rollback de transactie bij een fout
        $db->rollBack();
        die("Error!: " . $e->getMessage());
    }
} else {
    // Als er geen producten in de winkelwagen zijn, doorsturen naar de index pagina
    header("Location: index.php");
    exit();
}
?>
