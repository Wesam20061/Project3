<?php
    session_start();

    // Controleer of de gebruiker is ingelogd en de juiste rechten heeft (niet geïmplementeerd in dit voorbeeld)

    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['bestellingID'])) {
        $bestellingID = $_POST['bestellingID'];

        try {
            $db = new PDO("mysql:host=localhost;dbname=webshop top scoot", "root", "");
            $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            // Begin transactie
            $db->beginTransaction();

            // Verwijder eerst alle gerelateerde bestelling_producten records
            $deleteProducten = $db->prepare("DELETE FROM bestelling_producten WHERE BestellingID = :bestellingID");
            $deleteProducten->execute([':bestellingID' => $bestellingID]);

            // Verwijder nu de bestelling zelf
            $deleteBestelling = $db->prepare("DELETE FROM bestellingen WHERE BestellingID = :bestellingID");
            $deleteBestelling->execute([':bestellingID' => $bestellingID]);

            // Commit transactie
            $db->commit();

            // Redirect naar bestellingen overzichtspagina of een succesmelding pagina
            header("Location: bestellingen.php");
            exit();

        } catch (PDOException $e) {
            $db->rollBack();
            die("Fout bij het verwijderen van de bestelling: " . $e->getMessage());
        }
    } else {
        // Redirect naar bestellingen overzichtspagina als er geen POST verzoek is of als de bestellingID niet is gezet
        header("Location: bestellingen.php");
        exit();
    }
?>