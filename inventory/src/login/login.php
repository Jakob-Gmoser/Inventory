
<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Login</title>
    <link rel="icon" type="image/x-icon" href="../icons/icon.png">
    <link rel="stylesheet" href="login.css">
    <script src="../config/config.js"></script>
    <script src="login.js"></script>
</head>
<body>
    <div class="login-container">
        <h1 class="login-header">Willkommen zurück</h1>
        <div id="error-message" style="display: none">Test</div>
        <br>
        <form onsubmit="pressed_login_btn(event)">
            <div class="floating-group">
                <input type="email" id="email" name="email" placeholder=" " autocomplete="email" required />
                <label for="email">E-Mail Adresse</label>
            </div>
            <div class="floating-group">
                <input type="password" id="password" name="password" placeholder=" " autocomplete="current-password" required />
                <label for="password">Passwort</label>
            </div>
            <div>
                <div class="registration">
                    <a href="../registration/registration.php" class="registration">Registrierung</a>
                </div>
                <div class="forgot-password"> 
                    <a href="#" class="forgot-password">Passwort vergessen?</a>
                </div>
            </div>
            <button type="submit">Einloggen</button>
        </form>
    </div>
</body>
</html>
