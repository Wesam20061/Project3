<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Scooter Webshop - Bestellingen Overzicht</title>
    <link rel="stylesheet" href="style.css">
  
</head>
<body>

<?php
include('header.php'); // Inclusie van de header

echo "<form id='zoekFormulier' method='get'>"; // Zoekformulier met GET-methode
echo "<input type='text' id='zoek' name='zoekterm' placeholder='Zoek op bestelling ID of BestelDatum (YYYY-MM-DD)'>";
echo "<button type='submit'>Zoeken</button>"; // Knop voor het indienen van het zoekformulier
echo "</form>";

try {
    $db = new PDO("mysql:host=localhost;dbname=webshop top scoot", "root", ""); // Verbinding maken met de database
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); // Foutafhandelingsmodus instellen
    
    if(isset($_GET['zoekterm'])) {
        $zoekterm = $_GET['zoekterm'];
        
        // Query voor het ophalen van bestellingen op basis van zoekterm
        $bestellingenQuery = $db->prepare("SELECT BestellingID, KlantID, BestelDatum FROM bestellingen WHERE BestellingID LIKE :zoekterm OR BestelDatum LIKE :zoekterm ORDER BY BestelDatum DESC");
        $bestellingenQuery->execute([':zoekterm' => "%$zoekterm%"]);
    } else {
        // Query voor het ophalen van alle bestellingen
        $bestellingenQuery = $db->query("SELECT BestellingID, KlantID, BestelDatum FROM bestellingen ORDER BY BestelDatum DESC");
    }
    
    // Resultaten ophalen
    $bestellingen = $bestellingenQuery->fetchAll(PDO::FETCH_ASSOC);

    if ($bestellingen) {
        foreach ($bestellingen as $bestelling) {
            // Loop door elke bestelling om deze weer te geven
            echo "<div class='bestelling'>";
            echo "<h2>Bestelling ID: " . htmlspecialchars($bestelling['BestellingID']) . "</h2>";
            echo "<p>Klant ID: " . htmlspecialchars($bestelling['KlantID']) . "</p>";
            echo "<p>BestelDatum: " . htmlspecialchars($bestelling['BestelDatum']) . "</p>";
            echo "<ul>";

            $totaalPrijsBestelling = 0;
            
            // Query voor het ophalen van producten voor deze bestelling
            $productenQuery = $db->prepare("SELECT p.Naam, p.AfbeeldingURL, bp.Aantal, bp.PrijsPerStuk FROM bestelling_producten bp JOIN producten p ON bp.ProductID = p.ProductID WHERE bp.BestellingID = :bestellingID");
            $productenQuery->execute([':bestellingID' => $bestelling['BestellingID']]);
            $producten = $productenQuery->fetchAll(PDO::FETCH_ASSOC);

            foreach ($producten as $product) {
                // Loop door elk product in de bestelling
                $totaalPrijsProduct = $product['PrijsPerStuk'] * $product['Aantal'];
                $totaalPrijsBestelling += $totaalPrijsProduct;
                echo "<li><img src='" . htmlspecialchars($product['AfbeeldingURL']) . "' alt='" . htmlspecialchars($product['Naam']) . "''> " . htmlspecialchars($product['Naam']) . " <br> Aantal: " . htmlspecialchars($product['Aantal']) . " <br> Prijs: €" . htmlspecialchars($product['PrijsPerStuk']) . "</li>";
            }
            
            echo "<p>Totale prijs van bestelling: €" . htmlspecialchars($totaalPrijsBestelling) . "</p>";
            echo "</ul>";

            // Verwijderingsformulier voor elke bestelling
            echo "<form action='verwijder_bestelling.php' method='post'>";
            echo "<input type='hidden' name='bestellingID' value='" . $bestelling['BestellingID'] . "'>";
            echo "<button type='submit' onclick=\"return confirm('Weet je zeker dat je deze bestelling wilt verwijderen?');\">Verwijderen</button>";
            echo "</form>";
            echo "</div>";
        }
    } else {
        echo "<p>Er zijn geen bestellingen gevonden.</p>"; // Melding als er geen bestellingen zijn
    }
} catch(PDOException $e) {
    die("Fout bij het ophalen van de bestellingen: " . $e->getMessage());
}

include('footer.php'); // Inclusie van de footer
?>


</script>
</body>
</html>

