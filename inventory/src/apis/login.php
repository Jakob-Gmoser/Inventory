
<?php

session_start(); 

error_reporting(0);
ini_set("display_errors", 0);

include "database_connection.php";

function check_for_error_message($error_message_string) {
    if ($error_message_string) {
        echo json_encode(["error" => $error_message_string]);
        exit;
    }
}

function get_user($conn, $users_table, $email, $false_email_or_password) {
    $result = $conn->query("SELECT ID, password, username FROM $users_table WHERE email='$email'");

    return $result->fetch_assoc();
}

function check_for_correct_login($conn, $users_table, $email, $password, $false_email_or_password) {
    $user = get_user($conn, $users_table, $email, $false_email_or_password);

    if ($user === null || $user === false) {
        return $false_email_or_password;
    } else {
        if (password_verify($password, $user["password"])) {
            $_SESSION["user_id"] = $user["ID"];
            $_SESSION["username"] = $user["username"];

            echo json_encode(["redirect" => "../inventory/inventory.php"]);
            exit;
        } else {
            return $false_email_or_password;
        }
    }
}

function check_for_connection($conn, $database_connection_failed) {
    if (is_string($conn)) {
        return $database_connection_failed;
    }
}

$email = $_POST["email"];
$password = $_POST["password"];

$error_message_string = check_for_connection($conn, $error_message->database_connection_failed);

check_for_error_message($error_message_string);

$error_message_string = check_for_correct_login($conn, $users_table, $email, $password, $error_message->false_email_or_password);

check_for_error_message($error_message_string);

$conn->close();

?>
