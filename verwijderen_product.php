<?php
    // Het proberen om een databaseverbinding tot stand te brengen
    try {
        // Een nieuwe PDO-object maken voor databaseverbinding
        $conn = new PDO("mysql:host=localhost;dbname=webshop top scoot", "root", "");
        // Instellen van de foutmodus om uitzonderingen te gebruiken voor foutafhandeling
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Controleren of 'id' is ingesteld in de URL
        if(isset($_GET['id'])){
            // 'id' ophalen uit de URL
            $id = $_GET['id'];
            // SQL-query voor het verwijderen van een product met de opgegeven 'id'
            $sql = "DELETE FROM producten WHERE ProductID = :id";
            // Voorbereiden van de SQL-query
            $stmt = $conn->prepare($sql);
            // Binden van de parameter ':id' aan de waarde van 'id' uit de URL
            $stmt->bindParam(':id', $id);
            // Uitvoeren van de SQL-query
            $stmt->execute();

            // Controleren of er rijen zijn beïnvloed door de SQL-query (of er een product is verwijderd)
            if($stmt->rowCount() > 0){
                // Bericht weergeven dat het verwijderen is gelukt en doorsturen naar de productenpagina
                echo "<script>alert('Verwijderen is gelukt')</script>";
                echo "<script>location.replace('producten.php'); </script>";
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