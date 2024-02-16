<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inloggen</title>
    <link rel="stylesheet" href="stijl.css">
</head>
<body>
    <div class="login-container">
        <h2>Inloggen</h2>
        <form id="loginForm">
            <div class="form-group">
                <label for="username">Gebruikersnaam:</label>
                <input type="text" id="username" name="username" required>
            </div>
            <div class="form-group">
                <label for="password">Wachtwoord:</label>
                <input type="password" id="password" name="password" required>
            </div>
            <button type="submit">Inloggen</button>
        </form>
    </div>
    <script>document.getElementById("loginForm").addEventListener("submit", function(event) {
    event.preventDefault(); // Voorkom standaardformulierinzending

    // Haal gebruikersnaam en wachtwoord op
    var username = document.getElementById("username").value;
    var password = document.getElementById("password").value;

    // Simpele inlogvalidatie (vervang dit met je eigen validatielogica)
    if (username === "admin" && password === "klant") {
        // Redirect naar de andere pagina als inloggegevens correct zijn
        window.location.href = "klanten.php";
    } else {
        alert("Ongeldige inloggegevens. Probeer opnieuw.");
    }
});
</script>
</body>
</html>
