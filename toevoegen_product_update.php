<?php
try {
    $db = new PDO("mysql:host=localhost;dbname=webshop top scoot;", "root", "");
    $query = $db->prepare("INSERT INTO `producten` (`Naam`, `Beschrijving`, `Prijs`, `AfbeeldingURL`) VALUES (?, ?, ?, ?)");
    
    $naam = $_POST['naam'];
    $beschrijving = $_POST['beschrijving'];
    $prijs = $_POST['prijs'];
    $afbeelding_url = $_POST['afbeelding_url'];
    
    $query->bindParam(1, $naam);
    $query->bindParam(2, $beschrijving);
    $query->bindParam(3, $prijs);
    $query->bindParam(4, $afbeelding_url);
    
    $query->execute();
    
    header("Location: producten.php"); // Redirect to your producten.php page after adding the product
    exit();
} catch(PDOException $e) {
    die("Error!: " . $e->getMessage());
}
?>
