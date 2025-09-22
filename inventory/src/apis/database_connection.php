
<?php

include "../config/config.php";

function connect_to_db($servername, $username, $password, $database, $database_connection_failed) {
    try {
        $conn = new mysqli($servername, $username, $password, $database);
    } catch (Exception $e) {
        return $database_connection_failed;
    }

    if ($conn->connect_error) {
        return $database_connection_failed;
    }

    return $conn;
}

$conn = connect_to_db($servername, $username, $password, $database, $error_message->database_connection_failed);

?>
