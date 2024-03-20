<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Scooter Webshop</title>
    <link rel="stylesheet" href="style.css">
    <script src="js.js"></script>
</head>
<body>
<?php include 'header.php'; ?> <!-- Inclusie van de header -->

<main>
    <h1>Contact</h1>
    <p>Heeft u vragen? Neem gerust contact met ons op via het onderstaande formulier.</p>
    <form action="index.php" method="post"> <!-- Formulier voor het verzenden van een bericht -->
        <label for="naam">Uw naam:</label>
        <input type="text" id="naam" name="naam" required> <!-- Naamveld -->
        <label for="email">Uw email:</label>
        <input type="email" id="email" name="email" required> <!-- E-mailveld -->
        <label for="bericht">Uw bericht:</label>
        <textarea id="bericht" name="bericht" required></textarea> <!-- Berichtveld -->
        <button type="submit">Bericht versturen</button> <!-- Verzendknop -->
    </form>
</main>

<?php include 'footer.php'; ?> <!-- Inclusie van de footer -->
</body>
</html>

