
<?php

session_start();

include "database_connection.php";

function download_img($product_id) {
    if (isset($_FILES["img"]) && $_FILES["img"]["error"] === 0) {
        $upload_dir = "../product_images/$product_id/";
        $img_name = $_FILES["img"]["name"];
        $target_path = $upload_dir . $img_name;

        $allowed_types = ["image/jpeg", "image/png", "image/webp", "image/gif"];
        if (in_array($_FILES["img"]["type"], $allowed_types)) {
            if (move_uploaded_file($_FILES["img"]["tmp_name"], $target_path)) {
                echo "Image uploaded successfully: $target_path";
            } else {
                echo "Error saving the file.";
            }
        } else {
            echo "Only JPG, PNG, WEBP, GIF files are allowed.";
        }
    } else {
        echo "No image selected or upload error.";
    }

    return $target_path;
}

function update_product_on_db($conn, $products_table) {
    $product_id = $_POST["product_id"];
    $productname = $_POST["product_name"];
    $amount = $_POST["product_amount"];
    $price = $_POST["product_price"];
    $category = $_POST["product_category"];
    $barcode = $_POST["barcode"];

    $user_id = $_SESSION["user_id"];

    $upload_dir = download_img($product_id);

    if ($amount == "") {
        $amount = 0;
    }

    if ($price == "") {
        $price = 0;
    }

    if ($barcode == "") {
        $barcode = 0;
    }

    if ($category == "") {
        $category = "-";
    }

    $sql = "UPDATE $products_table p
            SET p.productname = '$productname',
                p.amount = $amount,
                p.price = $price,
                p.category = '$category',
                p.barcode = $barcode";

    if ($upload_dir) {
        $sql .= ", p.img_path = '$upload_dir'";
    }

    $sql .= " WHERE p.ID = $product_id AND p.user_ID = $user_id";

    echo($sql);

    if ($conn->query($sql) === TRUE) {
        echo "New product created successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

update_product_on_db($conn, $products_table);

$conn->close();

?>
