<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Review Toevoegen</title>
    <link rel="stylesheet" href="stijl.css">
</head>
<body>

<?php include 'header.php'; ?>

<div class="toevoegen-formulier">
    <h2 class='toevoegen'> Schrijf een Review </h2>
    <form action="toevoegen_review_update.php" method="post">
        <label for="rating">Rating:</label>
        <input type="number" id="rating" name="rating" min="1" max="10" required><br><br>

        <label for="comment">Comment:</label>
        <textarea id="comment" name="comment" required></textarea><br><br>

        <label for="datum">Datum:</label>
        <input type="date" id="datum" name="datum" required><br><br>

        <input type="submit" value="Toevoegen">
    </form>
</div>

<?php include 'footer.php'; ?>

</body>
</html>
