<?php
// Controleer of er een bestellings-ID is doorgegeven via de URL
if(isset($_GET['id'])) {
    $bestellingID = $_GET['id'];

    try {
        // Maak verbinding met de database
        $db = new PDO("mysql:host=localhost;dbname=webshop top scoot", "root", "");

        // Bereid de SQL-query voor om de bestelling te verwijderen
        $query = $db->prepare("DELETE FROM bestellingen WHERE BestellingID = :bestellingID");
        $query->bindParam(':bestellingID', $bestellingID);
        
        // Voer de query uit
        $query->execute();

        // Redirect terug naar de pagina met de bestellingen
        header("Location: bestellingen.php");
        exit();
    } catch(PDOException $e) {
        // Als er een fout optreedt, toon dan een foutmelding
        die("Fout!: " . $e->getMessage());
    }
} else {
    // Als er geen bestellings-ID is doorgegeven, toon dan een foutmelding
    echo "Geen bestellings-ID opgegeven.";
}
?>
