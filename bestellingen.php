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
    $query = $db->prepare("SELECT * FROM `bestellingen`;");
    $query->execute();
    $result = $query->fetchAll(PDO::FETCH_ASSOC);
    
    foreach($result as $data){
        echo "<div class='product'>";
        echo "<h1>Bestel Datum " . htmlspecialchars($data['Datum']) .  "</h1>";
        echo "<h2 class='Beschrijving'> totaal €" . htmlspecialchars($data['TotalePrijs']) . "</h2>";
        echo "<h1> " . htmlspecialchars($data['Status']) . "</h1>";
        echo "<a class='wijzig' href='wijzig_bestellingen.php?id=" . $data['BestellingID'] . "'>" . "wijzig</a>";
        echo "<a class='verwijderen' href='verwijderen_bestellingen.php?id=" . $data['BestellingID'] . "'>" . "verwijderen</a>";
        echo "</div>";
        
    }
}

catch(PDOException $e){
    die("Error!: " . $e->getMessage());
}
    
include('footer.php');
?>
</body>
</html>



