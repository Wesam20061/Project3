<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Wijzig Klant</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <?php
        // Inclusief van het header-bestand
        include('header.php');

        // Controleert of er een klant-ID is doorgegeven via de URL
        if(isset($_GET['id'])) {
            // Haalt het klant-ID op uit de URL
            $klantID = $_GET['id'];

            try {
                // Maakt verbinding met de database
                $db = new PDO("mysql:host=localhost;dbname=webshop top scoot", "root", "");
                
                // Bereidt de query voor om de klantgegevens op te halen
                $query = $db->prepare("SELECT * FROM `klanten` WHERE KlantID = :klantID");
                $query->bindParam(':klantID', $klantID);
                $query->execute();
                $klant = $query->fetch(PDO::FETCH_ASSOC);
                
                if($klant) {
                    // Toont het formulier om klantgegevens te bewerken
                    echo "<div class='edit-form'>";
                    echo "<h2 class='wijzig'>Wijzig Klantgegevens</h2>";
                    echo "<form action='update_klant.php' method='POST'>";
                    echo "<input type='hidden' name='klantID' value='" . $klant['KlantID'] . "'>";
                    echo "Naam: <input type='text' name='naam' value='" . htmlspecialchars($klant['Naam']) . "'><br>";
                    echo "Email: <input type='email' name='email' value='" . htmlspecialchars($klant['Email']) . "'><br>";
                    echo "Telefoonnummer: <input type='text' name='telefoonnummer' value='" . htmlspecialchars($klant['Telefoonnummer']) . "'><br>";
                    echo "Adres: <input type='text' name='adres' value='" . htmlspecialchars($klant['Adres']) . "'><br>";
                    echo "<input type='submit' value='Opslaan'>";
                    echo "</form>";
                    echo "</div>";
                } else {
                    echo "Klant niet gevonden.";
                }
            } catch(PDOException $e) {
                // Toont een foutmelding als er een PDOException optreedt
                die("Error!: " . $e->getMessage());
            }
        } else {
            // Toont een melding als er geen klant-ID is opgegeven in de URL
            echo "Geen klant-ID opgegeven.";
        }

        // Inclusief van het footer-bestand
        include('footer.php');
    ?>
</body>
</html>
