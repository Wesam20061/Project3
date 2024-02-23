<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Scooter Webshop</title>
    <link rel="stylesheet" href="s.css">
    
</head>
<body>
    

<?php
include('header.php');





$aantalProductenInWinkelwagen = isset($_SESSION['winkelwagen']) ? count($_SESSION['winkelwagen']) : 0;// Controleer of de winkelwagen sessie bestaat en of er producten zijn toegevoegd
if(isset($_SESSION['winkelwagen']) && !empty($_SESSION['winkelwagen'])) {
    // Verbinding maken met de database
    try {
        $db = new PDO("mysql:host=localhost;dbname=webshop top scoot", "root", "");
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Voorbereiden van de query om productdetails op te halen
        $query = $db->prepare("SELECT * FROM producten WHERE ProductID = :productID");

        echo "<h1>Winkelwagen</h1>";
        echo "<ul>";

        // Voor elk product in de winkelwagen
        foreach ($_SESSION['winkelwagen'] as $productID) {
            // Productdetails ophalen
            $query->bindParam(':productID', $productID);
            $query->execute();
            $product = $query->fetch(PDO::FETCH_ASSOC);

            // Productdetails weergeven
            echo "<div class='product'>";
            echo "<img src='" . htmlspecialchars($product['AfbeeldingURL']) . "' alt='" . htmlspecialchars($product['Naam']) . "' />";
            echo "<h1>" . htmlspecialchars($product['Naam']) .  "</h1>";
            echo "<h2 class='Beschrijving'>" . htmlspecialchars($product['Beschrijving']) . "</h2>";
            echo "<h1> €" . htmlspecialchars($product['Prijs']) . "</h1>";
            echo "<a class='verwijderen' href='verwijderen_winkelwagen.php?id=" . $product['ProductID'] . "'>" . "verwijderen uit winkelwagen</a>";
            //voeg een bestel knop toe
            echo "</div>";
        }

        echo "</ul>";

        echo "<form action='bestel.php' method='GET'>";
        echo "<input type='hidden' name='id' value='" . $product['ProductID'] . "'>";
        echo "<button type='submit' class='bestel'>bestellen</button>";
        echo "</form>";

    } catch (PDOException $e) {
        die("Error!: " . $e->getMessage());
    }
} else {
    // Als de winkelwagen leeg is, toon een bericht
    echo "<h1>Winkelwagen</h1>";
    echo "<p>Uw winkelwagen is leeg.</p>";
}

include('footer.php');


?>

<script src="js.js"></script>
</body>
</html>




