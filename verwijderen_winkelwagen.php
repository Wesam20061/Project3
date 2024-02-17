<?php
session_start();

// Controleer of het product-ID is doorgegeven via de URL
if(isset($_GET['id'])) {
    $productID = $_GET['id'];

    // Controleer of de winkelwagen bestaat en niet leeg is
    if(isset($_SESSION['winkelwagen']) && !empty($_SESSION['winkelwagen'])) {
        // Zoek het product in de winkelwagen en verwijder het
        $index = array_search($productID, $_SESSION['winkelwagen']);
        if($index !== false) {
            unset($_SESSION['winkelwagen'][$index]);
            // Herindexeer de winkelwagen array
            $_SESSION['winkelwagen'] = array_values($_SESSION['winkelwagen']);
            echo "Product succesvol verwijderd uit de winkelwagen.";
        } else {
            echo "Product niet gevonden in de winkelwagen.";
        }
    } else {
        echo "Er zijn geen producten in de winkelwagen om te verwijderen.";
    }

    // Doorsturen naar index.php
    header("Location: index.php");
    exit(); // Zorg ervoor dat er geen code wordt uitgevoerd na het doorsturen
} else {
    echo "Geen product-ID opgegeven om te verwijderen.";
}
?>
