
<?php

error_reporting(0);
ini_set("display_errors", 0);

include "database_connection.php";

function check_if_email_is_available($conn, $users_table, $email, $email_not_available) {
    $result = $conn->query("SELECT ID FROM $users_table WHERE email='$email'");

    if ($result->num_rows > 0) {
        return $email_not_available;
    }
}

function check_for_error_message($error_message_string) {
    if ($error_message_string) {
        echo $error_message_string;
        exit;
    }
}

function hash_password($password) {
    $hash = password_hash($password, PASSWORD_DEFAULT);

    return $hash;
}

function add_user_to_db($conn, $email, $username, $password, $users_table, $database_connection_failed, $user_created) {
    $password = hash_password($password);

    $sql = "INSERT INTO $users_table (email, username, password) VALUES ('$email', '$username', '$password')";
    
    if ($conn->query($sql) === TRUE) {
        return $user_created;
    } else {
        return $database_connection_failed;
    }
}

function check_for_connection($conn, $database_connection_failed) {
    if (is_string($conn)) {
        return $database_connection_failed;
    }
}

$email = $_POST["email"];
$username = $_POST["username"];
$password = $_POST["password"];

$error_message_string = check_for_connection($conn, $error_message->database_connection_failed);

check_for_error_message($error_message_string);

$error_message_string = check_if_email_is_available($conn, $users_table, $email, $error_message->email_not_available);

check_for_error_message($error_message_string);

$error_message_string = add_user_to_db($conn, $email, $username, $password, $users_table, $error_message->database_connection_failed, 
$error_message->user_created);

check_for_error_message($error_message_string);

$conn->close();

?>
