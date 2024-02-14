<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Wijzig Bestelling</title>
    <link rel="stylesheet" href="stijl.css">
</head>
<body>

<?php
include('header.php');

// Controleer of er een bestelling-ID is doorgegeven via de URL
if(isset($_GET['id'])) {
    $bestellingID = $_GET['id'];

    try{
        // Maak verbinding met de database
        $db = new PDO("mysql:host=localhost;dbname=webshop top scoot", "root", "");
        
        // Bereid de query voor om de bestellingsgegevens op te halen
        $query = $db->prepare("SELECT * FROM `bestellingen` WHERE BestellingID = :bestellingID");
        $query->bindParam(':bestellingID', $bestellingID);
        $query->execute();
        $bestelling = $query->fetch(PDO::FETCH_ASSOC);
        
        if($bestelling) {
            // Het formulier om bestellingsgegevens te bewerken
            echo "<div class='edit-form'>";
            echo "<h2 class='wijzig'>Wijzig Bestelling</h2>";
            echo "<form action='update_bestelling.php' method='POST'>";
            echo "<input type='hidden' name='bestellingID' value='" . $bestelling['BestellingID'] . "'>";
            echo "Bestel Datum: " . htmlspecialchars($bestelling['Datum']) . "<br>";
            echo "Totale Prijs: <input type='text' name='totalePrijs' value='" . htmlspecialchars($bestelling['TotalePrijs']) . "'><br>";
            echo "Status: <input type='text' name='status' value='" . htmlspecialchars($bestelling['Status']) . "'><br>";
            echo "<input type='submit' value='Opslaan'>";
            echo "</form>";
            echo "</div>";
        } else {
            echo "Bestelling niet gevonden.";
        }
    } catch(PDOException $e) {
        die("Error!: " . $e->getMessage());
    }
} else {
    echo "Geen bestelling-ID opgegeven.";
}

include('footer.php');
?>

</body>
</html>
