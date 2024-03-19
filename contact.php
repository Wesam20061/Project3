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
<?php include 'header.php'; ?>




<main>
    <h1>Contact</h1>
    <p>Heeft u vragen? Neem gerust contact met ons op via het onderstaande formulier.</p>
    <form action="index.php" method="post">
        <label for="naam">Uw naam:</label>
        <input type="text" id="naam" name="naam" required>
        <label for="email">Uw email:</label>
        <input type="email" id="email" name="email" required>
        <label for="bericht">Uw bericht:</label>
        <textarea id="bericht" name="bericht" required></textarea>
        <button type="submit">Bericht versturen</button>

    </form>
</main>






<?php include 'footer.php'; ?>
</body>
</html>

