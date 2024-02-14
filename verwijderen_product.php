<?php

// auteur : ahmad
// funtie: data fiets verwijderen uit databese

try {
    $conn = new PDO("mysql:host=localhost;dbname=webshop top scoot", "root", "");
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if(isset($_GET['id'])){
        $id = $_GET['id'];
        $sql = "DELETE FROM producten WHERE ProductID = :id";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();

        if($stmt->rowCount() > 0){
            echo "<script>alert('verwijderen is gelukt')</script>";
            echo "<script>location.replace('producten.php'); </script>";
        } else {
            echo "<script>alert('verwijderen is niet gelukt')</script>";
        }
    } else {
        echo "id is niet gezet";
    }
} catch(PDOException $e) {
    echo "Error: " . $e->getMessage();
}

$conn = null;

