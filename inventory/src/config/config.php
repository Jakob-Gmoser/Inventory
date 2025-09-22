
<?php

// Database
$servername = "localhost";
$username = "root";
$password = "";
$database = "inventory";
$users_table = "users";
$products_table = "products";
$logistic_table = "logistic";

// Error messages
class ErrorMessages {
    public $database_connection_failed = "Verbindung zur Datenbank nicht möglich!";
    public $user_created = "Neuen Benutzer angelegt.";
    public $email_not_available = "E-mail wird schon verwendet!";
    public $false_email_or_password = "Falsche E-Mail oder Passwort";
}

$error_message = new ErrorMessages();

?>
