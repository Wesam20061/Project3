<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Klant Toevoegen</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <?php include('header.php'); ?>

    <!-- Het formulier voor het toevoegen van een nieuwe klant -->
    <div class="toevoegen-formulier">
        <h2 class='toevoegen'>Vul het formulier in</h2> <!-- Titel van het formulier -->
        <form action="toevoegen_klant_update.php" method="post"> <!-- Formulier actie en methode -->
            <!-- Naam invoerveld -->
            <label for="naam">Naam:</label>
            <input type="text" id="naam" name="naam" required><br><br>

            <!-- E-mail invoerveld -->
            <label for="email">E-mail:</label>
            <input type="email" id="email" name="email" required><br><br>

            <!-- Telefoonnummer invoerveld -->
            <label for="telefoonnummer">Telefoonnummer:</label>
            <input type="text" id="telefoonnummer" name="telefoonnummer" required><br><br>

            <!-- Adres invoerveld -->
            <label for="adres">Adres:</label>
            <input type="text" id="adres" name="adres" required><br><br>

            <!-- Verzendknop voor het toevoegen van de klant -->
            <input type="submit" value="Toevoegen">
        </form>
    </div>

    <?php include('footer.php'); ?>
</body>
</html>