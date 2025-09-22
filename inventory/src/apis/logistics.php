
<?php

session_start();

include "database_connection.php";

function add_logistics($conn, $logistic_table, $logistic_name, $product_name, $logistics, $amount, $user_id) {
    $sql = "INSERT INTO $logistic_table (logistic_name, product_name, action, amount, user_ID) VALUES ('$logistic_name', '$product_name', $logistics, $amount, $user_id)";

    echo($sql);

    if ($conn->query($sql) === TRUE) {
        echo "New logistics created successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

function update_product_on_db($conn, $products_table, $logistic_table) {
    $product_id = $_POST["product_id"];
    $logistic_name = $_POST["logistic_name"];
    $product_amount = $_POST["product_amount"];
    $product_name = $_POST["product_name"];
    $logistics = $_POST["logistics"];
    $amount = $_POST["amount"];

    $user_id = $_SESSION["user_id"];

    add_logistics($conn, $logistic_table, $logistic_name, $product_name, $logistics, $amount, $user_id);

    $amount = $logistics == 0 ? $product_amount + $amount : $product_amount - $amount ;

    $sql = "UPDATE $products_table       
            SET amount = $amount
            WHERE ID = $product_id AND user_ID = $user_id";

    echo($sql);

    if ($conn->query($sql) === TRUE) {
        echo "Product updated successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

update_product_on_db($conn, $products_table, $logistic_table);

$conn->close();

?>
