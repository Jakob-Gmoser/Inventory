
<?php

session_start();

include "database_connection.php";

function get_products($conn, $user_id, $products_table) {
    $result = $conn->query("SELECT productname, amount, price, category, barcode, img_path, ID FROM $products_table WHERE user_ID=$user_id");

    $products = [];
    if ($result) {
        while ($row = $result->fetch_assoc()) {
            $products[] = $row;
        }
        $result->free();
    }

    return $products;
}

$products = get_products($conn, $_SESSION["user_id"], $products_table);

$conn->close();

echo(json_encode($products));

?>
