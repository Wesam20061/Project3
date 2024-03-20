<!DOCTYPE html>
<html lang="nl">
<head>
    <!-- Meta-informatie instellen voor het document -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Review Toevoegen</title>
    <!-- Koppel de stylesheet voor de opmaak van de pagina -->
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <?php include 'header.php'; ?>
    <!-- Formulier voor het toevoegen van een nieuwe review -->
    <div class="toevoegen-formulier">
        <!-- Titel van het formulier -->
        <h2 class='toevoegen'>Schrijf een Review</h2>
        <!-- Het formulier zelf met invoervelden voor reviewinformatie -->
        <form action="toevoegen_review_update.php" method="post">
            <!-- Invoerveld voor de rating van de review -->
            <label for="rating">Rating:</label>
            <input type="number" id="rating" name="rating" min="1" max="10" required><br><br>

            <!-- Invoerveld voor het commentaar van de review -->
            <label for="comment">Comment:</label>
            <textarea id="comment" name="comment" required></textarea><br><br>

            <!-- Invoerveld voor de datum van de review -->
            <label for="datum">Datum:</label>
            <input type="date" id="datum" name="datum" required><br><br>

            <!-- Knop om het formulier te verzenden en de review toe te voegen -->
            <input type="submit" value="Toevoegen">
        </form>
    </div>
    <?php include 'footer.php'; ?>
</body>
</html>