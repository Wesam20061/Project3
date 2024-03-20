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
include('header.php');

try {
    $db = new PDO("mysql:host=localhost;dbname=webshop top scoot", "root", "");
    $query = $db->prepare("SELECT * FROM `producten`;");
    $query->execute();
    $result = $query->fetchAll(PDO::FETCH_ASSOC);

    echo "<a class='toevoegen' href='toevoegen_product.php'>" . "Product Toevoegen</a>";
    echo "<form id='zoekFormulier' method='get'>";
    echo "<input type='text' id='zoek' name='zoekterm' placeholder='Zoek op naam, beschrijving'>";
    echo "<button type='submit'>Zoeken</button>";
    echo "</form>";

    if(isset($_GET['zoekterm'])) {
        $zoekterm = $_GET['zoekterm'];
        // Voeg de zoekterm toe aan de SQL-query om te zoeken op naam en beschrijving
        $query = $db->prepare("SELECT * FROM `producten` WHERE Naam LIKE :zoekterm OR Beschrijving LIKE :zoekterm");
        $query->execute([':zoekterm' => "%$zoekterm%"]);
        $result = $query->fetchAll(PDO::FETCH_ASSOC);
    }

    foreach ($result as $data) {
        echo "<div class='product'>";
        echo "<img src='" . htmlspecialchars($data['AfbeeldingURL']) . "' alt='" . htmlspecialchars($data['Naam']) . "' />";
        echo "<h1>" . htmlspecialchars($data['Naam']) .  "</h1>";
        echo "<h2 class='Beschrijving'>" . htmlspecialchars($data['Beschrijving']) . "</h2>";
        echo "<h1> €" . htmlspecialchars($data['Prijs']) . "</h1>";
        echo "<a class='wijzig' href='toevoegen_winkelwagen.php?id=" . $data['ProductID'] . "'>" . "toevoegen aan winkelwagen</a>";
        echo "<a class='wijzig' href='wijzig_producten.php?id=" . $data['ProductID'] . "'>" . "wijzig</a>";
        echo "<a class='verwijderen' href='verwijderen_product.php?id=" . $data['ProductID'] . "'>" . "verwijderen</a>";
        echo "</div>";
    }
} catch (PDOException $e) {
    die("Error!: " . $e->getMessage());
}

include('footer.php');
?>
</body>
</html>



