<?php
    // Probeer een verbinding met de database tot stand te brengen en een nieuw product toe te voegen
    try {
        // Maak verbinding met de database
        $db = new PDO("mysql:host=localhost;dbname=webshop top scoot;", "root", "");
        
        // Bereid de SQL-query voor om een nieuw product toe te voegen
        $query = $db->prepare("INSERT INTO `producten` (`Naam`, `Beschrijving`, `Prijs`, `AfbeeldingURL`) VALUES (?, ?, ?, ?)");
        
        // Haal de gegevens van het POST-verzoek op
        $naam = $_POST['naam'];
        $beschrijving = $_POST['beschrijving'];
        $prijs = $_POST['prijs'];
        $afbeelding_url = $_POST['afbeelding_url'];
        
        // Bind de gegevens aan de parameters van de query
        $query->bindParam(1, $naam);
        $query->bindParam(2, $beschrijving);
        $query->bindParam(3, $prijs);
        $query->bindParam(4, $afbeelding_url);
        
        // Voer de query uit om het nieuwe product toe te voegen
        $query->execute();
        
        // Stuur de gebruiker door naar de producten.php pagina na het toevoegen van het product
        header("Location: producten.php");
        exit();
    } catch(PDOException $e) {
        // Toon een foutmelding als er een fout optreedt bij het toevoegen van het product
        die("Error!: " . $e->getMessage());
    }
?>