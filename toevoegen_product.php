<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Toevoegen</title>
    <link rel="stylesheet" href="stijl.css">
</head>
<body>

<?php include('header.php'); ?>

<div class="toevoegen-formulier">
    <h2 class='toevoegen'>Product Toevoegen</h2>
    <form action="toevoegen_product_update.php" method="post">
        <label for="naam">Naam:</label>
        <input type="text" id="naam" name="naam" required><br><br>

        <label for="beschrijving">Beschrijving:</label>
        <textarea id="beschrijving" name="beschrijving" required></textarea><br><br>

        <label for="prijs">Prijs:</label>
        <input type="number" id="prijs" name="prijs" min="0" step="0.01" required><br><br>

        <label for="afbeelding_url">Afbeelding URL:</label>
        <input type="url" id="afbeelding_url" name="afbeelding_url" required><br><br>

        <input type="submit" value="Toevoegen">
    </form>
</div>

<?php include('footer.php'); ?>

</body>
</html>
