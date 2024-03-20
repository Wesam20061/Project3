<?php
    // Probeer een verbinding met de database tot stand te brengen
    try {
        // Maak een PDO-object aan voor de databaseverbinding
        $db = new PDO("mysql:host=localhost;dbname=webshop top scoot;", "root", "");
        // Bereid een SQL-query voor om een nieuwe review toe te voegen aan de database
        $query = $db->prepare("INSERT INTO `review` (`rating`, `comment`, `review_date`) VALUES (?, ?, ?)");
        
        // Haal de gegevens van de nieuwe review op uit de POST-variabelen
        $rating = $_POST['rating'];
        $comment = $_POST['comment'];
        $datum = $_POST['datum'];
        
        // Koppel de gegevens aan de juiste parameters in de SQL-query
        $query->bindParam(1, $rating);
        $query->bindParam(2, $comment);
        $query->bindParam(3, $datum);
        
        // Voer de SQL-query uit om de review toe te voegen aan de database
        $query->execute();
        
        // Redirect naar de review.php pagina na het toevoegen van de review
        header("Location: review.php");
        exit();
    } catch(PDOException $e) {
        // Vang eventuele fouten op en toon een foutmelding als er een fout optreedt
        die("Error!: " . $e->getMessage());
    }
?>