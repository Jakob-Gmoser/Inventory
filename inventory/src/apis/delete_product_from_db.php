
<?php

session_start();

include "database_connection.php";

function delete_img($product_id) {
    $upload_dir = "../product_images/$product_id";

    try {
        if (is_dir($upload_dir)) {
            $files = array_diff(scandir($upload_dir), array('.', '..'));
            foreach ($files as $file) {
                unlink("$upload_dir/$file");
            }
            rmdir($upload_dir);
        }
    } catch (Exception $e) {
        echo "Caught exception: " . $e->getMessage();
    }
}

function delete_product_on_db($conn, $product_id, $user_id, $products_table) {
    delete_img($product_id);
    
    $sql = "DELETE p FROM $products_table p WHERE p.user_ID = $user_id AND p.ID = $product_id";

    echo($sql);

    if ($conn->query($sql) === TRUE) {
        echo "Product deleted successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$product_id = $_POST["product_id"];

delete_product_on_db($conn, $product_id, $_SESSION["user_id"], $products_table);

$conn->close();

?>
