
<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Registrierung</title>
    <link rel="icon" type="image/x-icon" href="../icons/icon.png">
    <link rel="stylesheet" href="registration.css">
    <script src="../config/config.js"></script>
    <script src="registration.js"></script>
</head>
<body>
    <div class="register-container">
        <h1 class="register-header">Neues Konto erstellen</h1>
        <div id="error-message" style="display:none;"></div>
        <br>
        <form onsubmit="pressed_register_btn(event)">
            <div class="input-group">
                <input type="email" id="email" name="email" placeholder=" " required />
                <label for="email">E-Mail Adresse</label>
            </div>
            <div class="input-group">
                <input type="text" id="username" name="username" placeholder=" " required minlength="3" />
                <label for="username">Benutzername</label>
            </div>
            <div class="input-group">
                <input type="password" id="password" name="password" placeholder=" " required minlength="6" />
                <label for="password">Passwort</label>
            </div>
            <button type="submit">Registrieren</button>
        </form>
    </div>
</body>
</html>
