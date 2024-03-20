<?php
    // Probeer een verbinding met de database tot stand te brengen en een nieuwe klant toe te voegen
    try {
        // Maak verbinding met de database
        $db = new PDO("mysql:host=localhost;dbname=webshop top scoot;", "root", "");
        
        // Bereid de SQL-query voor om een nieuwe klant toe te voegen
        $query = $db->prepare("INSERT INTO `klanten` (`Naam`, `Email`, `Telefoonnummer`, `Adres`) VALUES (?, ?, ?, ?)");
        
        // Haal de gegevens van het POST-verzoek op
        $naam = $_POST['naam'];
        $email = $_POST['email'];
        $telefoonnummer = $_POST['telefoonnummer'];
        $adres = $_POST['adres'];
        
        // Bind de gegevens aan de parameters van de query
        $query->bindParam(1, $naam);
        $query->bindParam(2, $email);
        $query->bindParam(3, $telefoonnummer);
        $query->bindParam(4, $adres);
        
        // Voer de query uit om de nieuwe klant toe te voegen
        $query->execute();
        
        // Stuur de gebruiker door naar de hoofdpagina na het toevoegen van de klant
        header("Location: index.php");
        exit();
    } catch(PDOException $e) {
        // Toon een foutmelding als er een fout optreedt bij het toevoegen van de klant
        die("Error!: " . $e->getMessage());
    }
?>