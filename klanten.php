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

try{
    $db = new PDO("mysql:host=localhost;dbname=webshop top scoot;", "root", "");
    $query = $db->prepare("SELECT * FROM `klanten`;");
    $query->execute();
    $result = $query->fetchAll(PDO::FETCH_ASSOC);
    echo "<a class='toevoegen' href='toevoegen_klant.php'>" . " Klant Toevoegen</a>";

    foreach($result as $data){
        echo "<div class='product'>";
        echo "<h1>" . htmlspecialchars($data['Naam']) .  "</h1>";
        echo "<h2>" . htmlspecialchars($data['Email']) . "</h2>";
        echo "<h1 > " . htmlspecialchars($data['Telefoonnummer']) . "</h1>";
        echo "<h1>adres: " . htmlspecialchars($data['Adres']) . "</h1>";
        echo "<a class='wijzig' href='wijzig_klant.php?id=" . $data['KlantID'] . "'>" . "wijzig</a>";
        echo "<a class='verwijderen' href='verwijderen_klant.php?id=" . $data['KlantID'] . "'>" . "verwijderen</a>";
        echo "</div>";
    }
    
    // Add "Toevoegen klant" button
}

catch(PDOException $e){
    die("Error!: " . $e->getMessage());
}
    
include('footer.php');
?>
</body>
</html>
