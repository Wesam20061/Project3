<?php
    // Start de sessie om toegang te krijgen tot de winkelwagen
    session_start();

    // Controleren of er een productID is meegegeven in de URL
    if(isset($_GET['id'])) {
        // Het productID uit de URL halen
        $productID = $_GET['id'];
        
        // Controleren of de winkelwagen sessie bestaat, zo niet, maak een nieuwe sessie
        if(!isset($_SESSION['winkelwagen'])) {
            $_SESSION['winkelwagen'] = [];
        }
        
        // Het product toevoegen aan de winkelwagen sessie
        $_SESSION['winkelwagen'][] = $productID;
        
        // Doorsturen naar de winkelwagen pagina
        header("Location: winkelwagen.php");
        exit; // Stoppen met de huidige scriptuitvoering na het doorsturen
    } else {
        // Weergeven van een melding als er geen productID is meegegeven in de URL
        echo "Geen productID gevonden.";
    }
?>