<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Wijzig Product</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<?php
include('header.php');

// Controleer of er een product-ID is doorgegeven via de URL
if(isset($_GET['id'])) {
    $productID = $_GET['id'];

    try{
        // Maak verbinding met de database
        $db = new PDO("mysql:host=localhost;dbname=webshop top scoot", "root", "");
        
        // Bereid de query voor om de productgegevens op te halen
        $query = $db->prepare("SELECT * FROM `producten` WHERE ProductID = :productID");
        $query->bindParam(':productID', $productID);
        $query->execute();
        $product = $query->fetch(PDO::FETCH_ASSOC);
        
        if($product) {
            // Het formulier om productgegevens te bewerken
            echo "<div class='edit-form'>";
            echo "<h2 class='wijzig'>Wijzig Product</h2>";
            echo "<form action='update_product.php' method='POST'>";
            echo "<input type='hidden' name='productID' value='" . $product['ProductID'] . "'>";
            echo "Naam: <input type='text' name='naam' value='" . htmlspecialchars($product['Naam']) . "'><br>";
            echo "Afbeelding URL: <input type='text' name='afbeeldingURL' value='" . htmlspecialchars($product['AfbeeldingURL']) . "'><br>";
            echo "Beschrijving: <textarea name='beschrijving'>" . htmlspecialchars($product['Beschrijving']) . "</textarea><br>";
            echo "Prijs: <input type='text' name='prijs' value='" . htmlspecialchars($product['Prijs']) . "'><br>";
            echo "<input type='submit' value='Opslaan'>";
            echo "</form>";
            echo "</div>";
        } else {
            echo "Product niet gevonden.";
        }
    } catch(PDOException $e) {
        die("Error!: " . $e->getMessage());
    }
} else {
    echo "Geen product-ID opgegeven.";
}

include('footer.php');
?>

</body>
</html>


