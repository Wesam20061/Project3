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

try {
    $db = new PDO("mysql:host=localhost;dbname=webshop top scoot", "root", "");
    
    $query = $db->prepare("SELECT * FROM bestellingen");
    $query->execute();
    $bestellingen = $query->fetchAll(PDO::FETCH_ASSOC);

    echo "<div class='bestellingen'>";
    foreach($bestellingen as $bestelling){
        echo "<div class='product'>";
        echo "<h2>Bestelling ID: " . htmlspecialchars($bestelling['BestellingID']) . "</h2>";
        echo "<h1>Product ID: " . htmlspecialchars($bestelling['productID']) . "</h1>";
        
        // Haal productgegevens op uit de tabel producten
        $productQuery = $db->prepare("SELECT * FROM producten WHERE ProductID = :productID");
        $productQuery->bindParam(':productID', $bestelling['productID']);
        $productQuery->execute();
        $product = $productQuery->fetch(PDO::FETCH_ASSOC);

        echo "<h1>Product Naam: " . htmlspecialchars($product['Naam']) . "</h1>";
        echo "<img src='" . htmlspecialchars($product['AfbeeldingURL']) . "' alt='" . htmlspecialchars($product['Naam']) . "' />";
        
        echo "<h3>Klant ID: " . htmlspecialchars($bestelling['klantID']) . "</h3>";
        echo "<h4>BestelDatum: " . htmlspecialchars($bestelling['BestelDatum']) .  "</h4>";
        echo "<h5>Prijs per stuk: €" . htmlspecialchars($product['Prijs']) . "</h5>";
        echo "<h6>Aantal: " . htmlspecialchars($bestelling['aantal']) . "</h6>";
        echo "<h6>Totaal prijs: €" . htmlspecialchars($product['Prijs'] * $bestelling['aantal']) . "</h6>";

        // Verwijderknop toevoegen met link naar verwijderen_bestelling.php
        echo "<a class='verwijderen' href='verwijderen_bestelling.php?id=" . $bestelling['BestellingID'] . "'>Verwijderen</a>";

        echo "</div>";
    }
    echo "</div>";

} catch(PDOException $e) {
    die("Fout!: " . $e->getMessage());
}

include('footer.php');
?>

</body>
</html>
