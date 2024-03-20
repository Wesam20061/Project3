<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Scooter Webshop - Winkelwagen</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

    <?php
        include('header.php');


        echo "<h1 class='wijzig'>Winkelwagen</h1>";

        if(isset($_SESSION['winkelwagen']) && count($_SESSION['winkelwagen']) > 0) {
            echo "<form action='bestel.php' method='post'>";
            echo "<ul class='productenlijst'>";

            // Databaseverbinding opzetten
            $db = new PDO("mysql:host=localhost;dbname=webshop top scoot", "root", "");
            $query = $db->prepare("SELECT * FROM producten WHERE ProductID = :productID");

            foreach ($_SESSION['winkelwagen'] as $productID) {
                $query->execute([':productID' => $productID]);
                $product = $query->fetch(PDO::FETCH_ASSOC);

                // Toon productdetails
                echo "<div class='bestelling'>";
                echo "<li class='product-item'>";
                echo "<img src='" . htmlspecialchars($product['AfbeeldingURL']) . "' alt='" . htmlspecialchars($product['Naam']) . "' />";
                echo "<div>" . htmlspecialchars($product['Naam']) . " <br> €" . htmlspecialchars($product['Prijs']) . "</div>";
                echo "</li>";
            }

            echo "</ul>";

            // Klant ID selectie
            echo "<select name='klantID' required>";
            echo "<option value=''>Selecteer een klant</option>";
            $klantenQuery = $db->query("SELECT KlantID, Naam FROM klanten");
            while ($klant = $klantenQuery->fetch(PDO::FETCH_ASSOC)) {
                echo "<option value='" . $klant['KlantID'] . "'>" . $klant['Naam'] . "</option>";
            }
            echo "</select>";
            echo "</div>";

            echo "<button type='submit' class='bestelknop'>Bestellen</button>";
            echo "</form>";
        } else {
            echo "<p>Uw winkelwagen is leeg.</p>";
        }

        include('footer.php');
    ?>
    <script src="js.js"></script>
</body>
</html>
