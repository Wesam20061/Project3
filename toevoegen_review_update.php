<?php
try {
    $db = new PDO("mysql:host=localhost;dbname=webshop top scoot;", "root", "");
    $query = $db->prepare("INSERT INTO `review` (`rating`, `comment`, `review_date`) VALUES (?, ?, ?)");
    
    $rating = $_POST['rating'];
    $comment = $_POST['comment'];
    $datum = $_POST['datum'];
    
    $query->bindParam(1, $rating);
    $query->bindParam(2, $comment);
    $query->bindParam(3, $datum);
    
    $query->execute();
    
    header("Location: review.php"); // Redirect to your reviews.php page after adding the review
    exit();
} catch(PDOException $e) {
    die("Error!: " . $e->getMessage());
}
?>
