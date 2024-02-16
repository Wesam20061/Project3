<?php
// Plaats hier je PDO-verbinding en query
$db = new PDO("mysql:host=localhost;dbname=webshop top scoot;", "root", "");
$query = $db->prepare("SELECT * FROM `klanten`;");
$query->execute();
$result = $query->fetchAll(PDO::FETCH_ASSOC);

// Geef de resultaten terug als JSON
echo json_encode($result);
?>


