<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Klant Toevoegen</title>
    <link rel="stylesheet" href="stijl.css">
</head>
<body>

<?php include('header.php'); ?>

<div class="toevoegen-formulier">
    <h2 class='toevoegen'>vul het formulier in </h2>
    <form action="toevoegen_klant_update.php" method="post">
        <label for="naam">Naam:</label>
        <input type="text" id="naam" name="naam" required><br><br>

        <label for="email">E-mail:</label>
        <input type="email" id="email" name="email" required><br><br>

        <label for="telefoonnummer">Telefoonnummer:</label>
        <input type="text" id="telefoonnummer" name="telefoonnummer" required><br><br>

        <label for="adres">Adres:</label>
        <input type="text" id="adres" name="adres" required><br><br>

        <input type="submit" value="Toevoegen">
    </form>
</div>


<?php include('footer.php'); ?>

</body>
</html>


