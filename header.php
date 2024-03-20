<link rel="stylesheet" href="style.css">
<script src="js.js"></script>


<?php
session_start();
$aantalProductenInWinkelwagen = isset($_SESSION['winkelwagen']) ? count($_SESSION['winkelwagen']) : 0;// Controleer of de winkelwagen sessie bestaat en of er producten zijn toegevoegd
?>

<!-- Dit is het headergedeelte van de website -->
<header>
    <!-- Logo van de website -->
    <a href="index.php"> <img src="logo.jpg" alt="Scooter Webshop Logo" class="logo"></a>        
    <!-- Navigatiemenu -->
    <nav>
        <ul>
            <!-- Navigatielinks -->
            <li class='h'><a href="index.php">Home</a></li>
            <li><a href="producten.php">Producten</a></li>
            <li><a href="inlog.php">Klanten</a></li>
            <li><a href="bestellingen.php">Bestellingen</a></li>
            <li><a href="over_ons.php">Over ons</a></li>
            <!-- Dropdownmenu -->
            <li class="dropdown">
                <a href="#" class="dropbtn">Menu</a>
                <!-- Dropdowninhoud -->
                <div class="dropdown-content">
                    <a href="producten.php">Producten</a>
                    <a href="inlog.php">Klanten</a>
                    <a href="bestellingen.php">Bestellingen</a>
                    <a href="over_ons.php">Over ons</a>
                </div>
            </li>
            <!-- Winkelwagenafbeelding met het aantal producten in de winkelwagen -->
            <a href="winkelwagen.php"> <img src="winkelwagen.png" class="winkel"></a>
            <p class="aantal-producten-winkelwagen"><?php echo $aantalProductenInWinkelwagen; ?></p>
        </ul>
    </nav>
</header>