<?php
session_start();

if(isset($_GET['id'])) {
    $productID = $_GET['id'];
    
    // Controleer of de winkelwagen sessie bestaat, zo niet, maak een nieuwe
    if(!isset($_SESSION['winkelwagen'])) {
        $_SESSION['winkelwagen'] = [];
    }
    
    // Voeg het product toe aan de winkelwagen sessie
    $_SESSION['winkelwagen'][] = $productID;
    
    // Stuur de gebruiker door naar de winkelwagen pagina
    header("Location: winkelwagen.php");
    exit;
} else {
    echo "Geen productID gevonden.";
}
?>
