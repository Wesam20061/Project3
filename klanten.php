<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Scooter Webshop</title>
    <link rel="stylesheet" href="style.css">
    <script src="js.js"></script>
</head>
<body>
    <?php
        // Inclusie van de header
        include('header.php');

        try {
            // Databaseverbinding opzetten
            $db = new PDO("mysql:host=localhost;dbname=webshop top scoot;", "root", "");

            // Zoekfunctionaliteit
            if(isset($_GET['zoekterm'])) {
                $zoekterm = $_GET['zoekterm'];
                // Query om klanten te zoeken op klantID, naam, e-mail, telefoonnummer of adres
                $query = $db->prepare("SELECT * FROM `klanten` WHERE KlantID LIKE :zoekterm OR Naam LIKE :zoekterm OR Email LIKE :zoekterm OR Telefoonnummer LIKE :zoekterm OR Adres LIKE :zoekterm");
                $query->execute([':zoekterm' => "%$zoekterm%"]);
            } else {
                // Als er geen zoekopdracht is, haal alle klanten op
                $query = $db->prepare("SELECT * FROM `klanten`");
                $query->execute();
            }

            $result = $query->fetchAll(PDO::FETCH_ASSOC);
            // Toevoegen van een link om een nieuwe klant toe te voegen
            echo "<a class='toevoegen' href='toevoegen_klant.php'>" . " Klant Toevoegen</a>";
            // Zoekformulier
            echo "<form id='zoekFormulier' method='get'>
                    <input type='text' id='zoekInput' name='zoekterm' placeholder='Zoek op klantid, naam, e-mail, telefoonnummer of adres'>
                    <button type='submit'>Zoeken</button>
                </form>";

            // Weergeven van de gevonden klanten
            foreach ($result as $data) {
                echo "<div class='product'>";
                echo "<h1 id='klant_" . htmlspecialchars($data['Naam']) . "'>" . htmlspecialchars($data['Naam']) .  "</h1>";
                echo "<h2>Klant ID: " . htmlspecialchars($data['KlantID']) . "</h2>"; // Toevoeging van Klant ID
                echo "<h2>" . htmlspecialchars($data['Email']) . "</h2>";
                echo "<h1>" . htmlspecialchars($data['Telefoonnummer']) . "</h1>";
                echo "<h1>adres: " . htmlspecialchars($data['Adres']) . "</h1>";
                // Link om een klant te wijzigen
                echo "<a class='wijzig' href='wijzig_klant.php?id=" . $data['KlantID'] . "'>" . "wijzig</a>";
                // Link om een klant te verwijderen
                echo "<a class='verwijderen' href='verwijderen_klant.php?id=" . $data['KlantID'] . "' onclick=\"return confirm('Weet je zeker dat je deze klant wilt verwijderen?');\">" . "verwijderen</a>";
                echo "</div>";
            }
        } catch (PDOException $e) {
            // Weergeven van een foutmelding bij een databasefout
            die("Error!: " . $e->getMessage());
        }

        // Inclusie van de footer
        include('footer.php');
    ?>
</body>
</html>
