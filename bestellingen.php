<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Scooter Webshop</title>
    <link rel="stylesheet" href="stijl.css">
    <script src="js.js"></script>
</head>
<body>


<?php
include('header.php');


session_start();

// Zoekopdracht verwerken
if(isset($_GET['zoek'])) {
    $zoekterm = $_GET['zoek'];

    try {
        $db = new PDO("mysql:host=localhost;dbname=webshop top scoot", "root", "");
        $query = $db->prepare("SELECT b.*, p.Naam AS ProductNaam, p.AfbeeldingURL, p.Prijs FROM `bestellingen` AS b INNER JOIN `producten` AS p ON b.ProductID = p.ProductID WHERE b.BestellingID = :zoekterm");
        $query->bindParam(':zoekterm', $zoekterm);
        $query->execute();
        $result = $query->fetchAll(PDO::FETCH_ASSOC);

        // Toon de zoekresultaten
        echo "<h2>Zoekresultaten voor Bestelling ID: " . htmlspecialchars($zoekterm) . "</h2>";
        foreach($result as $data){
            echo "<div class='product'>";
            echo "<h1>Bestelling ID: " . htmlspecialchars($data['BestellingID']) . "</h1>"; // Voeg BestellingID toe
            echo "<h2>Besteldatum: " . date('d-m-Y', strtotime($data['BestelDatum'])) .  "</h2>"; // Gebruik h2 voor datum
            echo "<img src='" . htmlspecialchars($data['AfbeeldingURL']) . "' alt='" . htmlspecialchars($data['ProductNaam']) . "' />";
            echo "<h3>Product Naam: " . htmlspecialchars($data['ProductNaam']) . "</h3>";
            echo "<h4>Prijs: €" . htmlspecialchars($data['Prijs']) . "</h4>";
            echo "<h4>Aantal: " . htmlspecialchars($data['Aantal']) . "</h4>";
            echo "<a class='verwijderen' href='verwijderen_bestellingen.php?id=" . $data['BestellingID'] . "'>" . "Verwijderen</a>";
            echo "</div>";
        }
    } catch(PDOException $e) {
        die("Fout!: " . $e->getMessage());
    }
}

// Normale weergave van bestellingen als er geen zoekopdracht is
try {
    $db = new PDO("mysql:host=localhost;dbname=webshop top scoot", "root", "");
    $query = $db->prepare("SELECT b.*, p.Naam AS ProductNaam, p.AfbeeldingURL, p.Prijs FROM `bestellingen` AS b INNER JOIN `producten` AS p ON b.ProductID = p.ProductID;");
    $query->execute();
    $result = $query->fetchAll(PDO::FETCH_ASSOC);
    
    echo "<form id='zoekFormulier'>
            <input type='text' id='zoek' name='zoek' placeholder='Zoek op Bestelling ID'>
            <button type='submit'>Zoeken</button>
          </form>";
    foreach($result as $data){
        echo "<div class='product'>";
        echo "<h1>Bestelling ID: " . htmlspecialchars($data['BestellingID']) . "</h1>"; // Voeg BestellingID toe
        echo "<h2>Besteldatum: " . date('d-m-Y', strtotime($data['BestelDatum'])) .  "</h2>"; // Gebruik h2 voor datum
        echo "<img src='" . htmlspecialchars($data['AfbeeldingURL']) . "' alt='" . htmlspecialchars($data['ProductNaam']) . "' />";
        echo "<h3>Product Naam: " . htmlspecialchars($data['ProductNaam']) . "</h3>";
        echo "<h4>Prijs: €" . htmlspecialchars($data['Prijs']) . "</h4>";
        echo "<h4>Aantal: " . htmlspecialchars($data['Aantal']) . "</h4>";
        echo "<a class='verwijderen' href='verwijderen_bestellingen.php?id=" . $data['BestellingID'] . "'>" . "Verwijderen</a>";
        echo "</div>";
    }
} catch(PDOException $e) {
    die("Fout!: " . $e->getMessage());
}







    
include('footer.php');
?>

</body>
</html>



