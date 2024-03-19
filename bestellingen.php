<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Scooter Webshop - Bestellingen Overzicht</title>
    <link rel="stylesheet" href="stijl.css">
</head>
<body>

<?php
include('header.php');

try {
    $db = new PDO("mysql:host=localhost;dbname=webshop top scoot", "root", "");
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Ophalen van alle bestellingen
    $bestellingenQuery = $db->query("SELECT BestellingID, KlantID, BestelDatum FROM bestellingen ORDER BY BestelDatum DESC");
    $bestellingen = $bestellingenQuery->fetchAll(PDO::FETCH_ASSOC);

    if ($bestellingen) {
        foreach ($bestellingen as $bestelling) {
            
            echo "<div class='producten'>";
            echo "<h2>Bestelling ID: " . htmlspecialchars($bestelling['BestellingID']) . " - Klant ID: " . htmlspecialchars($bestelling['KlantID']) . "</h2>";
            echo "<p>BestelDatum: " . htmlspecialchars($bestelling['BestelDatum']) . "</p>";
            echo "<ul>";

            $totaalPrijsBestelling = 0;

            // Ophalen van producten voor deze bestelling
            $productenQuery = $db->prepare("SELECT p.Naam, p.AfbeeldingURL, bp.Aantal, bp.PrijsPerStuk FROM bestelling_producten bp JOIN producten p ON bp.ProductID = p.ProductID WHERE bp.BestellingID = :bestellingID");
            $productenQuery->execute([':bestellingID' => $bestelling['BestellingID']]);
            $producten = $productenQuery->fetchAll(PDO::FETCH_ASSOC);

            foreach ($producten as $product) {
                $totaalPrijsProduct = $product['PrijsPerStuk'] * $product['Aantal'];
                $totaalPrijsBestelling += $totaalPrijsProduct;
                echo "<li><img src='" . htmlspecialchars($product['AfbeeldingURL']) . "' alt='" . htmlspecialchars($product['Naam']) . "' style='width:100px;'> " . htmlspecialchars($product['Naam']) . " - Aantal: " . htmlspecialchars($product['Aantal']) . " - Prijs per stuk: €" . htmlspecialchars($product['PrijsPerStuk']) . " - Totaal: €" . htmlspecialchars($totaalPrijsProduct) . "</li>";
            }
            // Binnen de foreach loop van elke bestelling

            
            echo "<p>Totale prijs van bestelling: €" . htmlspecialchars($totaalPrijsBestelling) . "</p>";
            echo "</ul>";

            // Binnen de foreach loop van elke bestelling
            echo "<form action='verwijder_bestelling.php' method='post'>";
            echo "<input type='hidden' name='bestellingID' value='" . $bestelling['BestellingID'] . "'>";
            echo "<button type='submit' onclick=\"return confirm('Weet je zeker dat je deze bestelling wilt verwijderen?');\">Verwijderen</button>";
            echo "</form>";
            echo "</div>";

        }
    } else {
        echo "<p>Er zijn geen bestellingen geplaatst.</p>";
    }

} catch(PDOException $e) {
    die("Fout bij het ophalen van de bestellingen: " . $e->getMessage());
}

include('footer.php');
?>
</body>
</html>
