<?php
    try {
        // Maak verbinding met de database
        $conn = new PDO("mysql:host=localhost;dbname=webshop top scoot", "root", "");
        // Stel de foutmodus in op ERRMODE_EXCEPTION om uitzonderingen te gebruiken voor foutafhandeling
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Controleren of er een 'id' is meegegeven in de URL
        if(isset($_GET['id'])){
            // Het 'id' uit de URL halen
            $id = $_GET['id'];
            // SQL-query voor het verwijderen van een klant met het opgegeven 'id'
            $sql = "DELETE FROM klanten WHERE KlantID = :id";
            // Voorbereiden van de SQL-query
            $stmt = $conn->prepare($sql);
            // Binden van de parameter ':id' aan de waarde van het 'id' uit de URL
            $stmt->bindParam(':id', $id);
            // Uitvoeren van de SQL-query
            $stmt->execute();

            // Controleren of er rijen zijn beïnvloed door de SQL-query (of er een klant is verwijderd)
            if($stmt->rowCount() > 0){
                // Bericht weergeven dat het verwijderen is gelukt en doorsturen naar de klantenpagina
                echo "<script>alert('Verwijderen is gelukt')</script>";
                echo "<script>location.replace('klanten.php'); </script>";
            } else {
                // Bericht weergeven dat het verwijderen niet is gelukt
                echo "<script>alert('Verwijderen is niet gelukt')</script>";
            }
        } else {
            // Melding weergeven als er geen 'id' is meegegeven in de URL
            echo "ID is niet gezet";
        }
    } catch(PDOException $e) {
        // Foutmelding weergeven als er een PDOException optreedt
        echo "Error: " . $e->getMessage();
    }
    // Databaseverbinding sluiten
    $conn = null;
?>