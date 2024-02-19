<?php
try {
    $db = new PDO("mysql:host=localhost;dbname=webshop top scoot;", "root", "");
    $query = $db->prepare("INSERT INTO `klanten` (`Naam`, `Email`, `Telefoonnummer`, `Adres`) VALUES (?, ?, ?, ?)");
    
    $naam = $_POST['naam'];
    $email = $_POST['email'];
    $telefoonnummer = $_POST['telefoonnummer'];
    $adres = $_POST['adres'];
    
    $query->bindParam(1, $naam);
    $query->bindParam(2, $email);
    $query->bindParam(3, $telefoonnummer);
    $query->bindParam(4, $adres);
    
    $query->execute();
    
    header("Location: index.php");
    exit();
} catch(PDOException $e) {
    die("Error!: " . $e->getMessage());
}
?>


