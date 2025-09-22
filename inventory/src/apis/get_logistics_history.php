
<?php

session_start();

include "database_connection.php";

function get_history($conn, $user_id, $logistic_table) {
    $result = $conn->query("SELECT date, logistic_name, product_name, action, amount FROM $logistic_table WHERE user_ID=$user_id");

    $history = [];
    if ($result) {
        while ($row = $result->fetch_assoc()) {
            $history[] = $row;
        }
        $result->free();
    }

    return $history;
}

$history = get_history($conn, $_SESSION["user_id"], $logistic_table);

$conn->close();

echo(json_encode($history));

?>
