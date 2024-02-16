<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Scooter Webshop</title>
    <link rel="stylesheet" href="stijl.css">
    <script src="js.js"></script>
</head>
<body>
<?php include 'header.php'; ?>

<?php


try {
    $db = new PDO("mysql:host=localhost;dbname=webshop top scoot;", "root", "");
    $query = $db->prepare("SELECT * FROM `review`;");
    $query->execute();
    $result = $query->fetchAll(PDO::FETCH_ASSOC);
    
    echo "<table>";
    echo "<tr>";
    echo "<th>Rating</th>";
    echo "<th>Comment</th>";
    echo "<th>Datum</th>";
    echo "</tr>";

    foreach($result as $data){
        echo "<tr>";
        echo "<td>" . htmlspecialchars($data['rating']) . "</td>";
        echo "<td>" . htmlspecialchars($data['comment']) . "</td>";
        echo "<td>" . htmlspecialchars($data['review_date']) . "</td>";
        echo "</tr>";
    }
    echo "</table>";
    echo "<a class='toevoegen' href='toevoegen_review.php'>" . "Schrijf een Review</a>";

} catch(PDOException $e) {
    die("Error!: " . $e->getMessage());
}
?>

<?php include 'footer.php'; ?>
</body>
</html>



