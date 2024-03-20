<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Toevoegen</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <?php include('header.php'); ?>

    <!-- Formulier voor het toevoegen van een nieuw product -->
    <div class="toevoegen-formulier">
        <!-- Titel van het formulier -->
        <h2 class='toevoegen'>Product Toevoegen</h2>
        <!-- Het formulier zelf met invoervelden voor productinformatie -->
        <form action="toevoegen_product_update.php" method="post">
            <!-- Invoerveld voor de naam van het product -->
            <label for="naam">Naam:</label>
            <input type="text" id="naam" name="naam" required><br><br>

            <!-- Invoerveld voor de beschrijving van het product -->
            <label for="beschrijving">Beschrijving:</label>
            <textarea id="beschrijving" name="beschrijving" required></textarea><br><br>

            <!-- Invoerveld voor de prijs van het product -->
            <label for="prijs">Prijs:</label>
            <input type="number" id="prijs" name="prijs" min="0" step="0.01" required><br><br>

            <!-- Invoerveld voor de URL van de afbeelding van het product -->
            <label for="afbeelding_url">Afbeelding URL:</label>
            <input type="url" id="afbeelding_url" name="afbeelding_url" required><br><br>

            <!-- Knop om het formulier te verzenden en het product toe te voegen -->
            <input type="submit" value="Toevoegen">
        </form>
    </div>
    <?php include('footer.php'); ?>
</body>
</html>