
<?php

session_start();

header("Cache-Control: no-cache, no-store, must-revalidate"); 
header("Pragma: no-cache");
header("Expires: 0");

if (!isset($_SESSION["user_id"])) {
    header("Location: ../login/login.php");
    exit;
}

$product_name = $_GET["product_name"] ?? null;
$product_amount = $_GET["product_amount"] ?? null;
$product_price = $_GET["product_price"] ?? null;
$product_category = $_GET["product_category"] ?? null;
$barcode = $_GET["barcode"] ?? null;
$img_path = $_GET["img_path"] ?? null;
$product_id = $_GET["product_id"]

?>

<!DOCTYPE html>
<html>
<head>
    <title>Produkt bearbeiten</title>
    <link rel="icon" type="image/x-icon" href="../icons/icon.png">
    <script src="https://unpkg.com/quagga@0.12.1/dist/quagga.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-LN+7fdVzj6u52u30Kp6M/trliBMCMKTyK833zpbD+pXdCLuTusPj697FH4R/5mcr" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js" integrity="sha384-ndDqU0Gzau9qJ1lfW4pNLlhNTkCfHzAVBReH9diLvGRem5+R9g2FzA8ZGN954O5Q" crossorigin="anonymous"></script>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,700;1,400&family=Montserrat:wght@300;400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../header/header.css">
    <link rel="stylesheet" href="edit_product.css">
    <link rel="stylesheet" href="../barcode/barcode_overlay.css">
    <script src="../header/header.js"></script>
    <script src="../config/config.js"></script>
</head>
<body>
    <?php
        include "../header/header.php";
    ?>

    <br>

    <div class="edit-product-container">
    <h2 class="edit-product-header">Produkt bearbeiten</h2>
    <form id="edit-product-form" onsubmit="edit_product(event, <?php echo htmlspecialchars($product_id); ?>)">
        <div class="form-inputs">
        <div class="mb-3">
            <label for="product-name" class="form-label">Produktname</label>
            <input type="text" class="form-control" id="product-name" name="name" value="<?php echo htmlspecialchars($product_name); ?>" required>
        </div>

        <div class="d-flex gap-3">
            <div class="flex-grow-1 mb-3">
            <label for="product-amount" class="form-label">Anzahl</label>
            <input type="number" class="form-control" id="product-amount" name="amount" min="0" value="<?php echo htmlspecialchars($product_amount); ?>">
            </div>

            <div class="flex-grow-1 mb-3">
            <label for="product-price" class="form-label">Preis (€)</label>
            <input type="number" class="form-control" id="product-price" name="price" step="0.01" min="0" value="<?php echo htmlspecialchars($product_price); ?>">
            </div>
        </div>

        <div class="mb-3">
            <label for="product-category" class="form-label">Kategorie</label>
            <input type="text" class="form-control" id="product-category" name="category" value="<?php echo htmlspecialchars($product_category); ?>">
        </div>

        <div class="form-actions d-flex gap-3">
            <input type="hidden" name="barcode" id="barcode-hidden" value="<?php echo htmlspecialchars($barcode); ?>">
            <button type="button" class="btn btn-warning" id="open-scanner">
                    <?php 
                        echo $barcode 
                            ? htmlspecialchars($barcode) . ' - Neu Scannen' 
                            : 'Scanner öffnen'; 
                    ?>
            </button>
            <button type="submit" class="btn btn-warning">Produkt bearbeiten</button>
        </div>
        </div>

        <div class="image-preview-container">
        <label for="product-image" class="form-label">Bild auswählen</label>
        <input type="file" class="form-control" id="product-image" accept="image/*" />
        <div class="image-preview" id="image-preview">
            <img id="preview-edit" src="<?php echo $img_path ? htmlspecialchars($img_path) : '../icons/icon.png'; ?>" alt="Image preview" />
        </div>
        </div>
    </form>
    </div>

    
    <?php
        include "../barcode/barcode_overlay.html";
    ?>

    <script src="../barcode/barcode_overlay.js"></script>

    <script src="edit_product.js"></script>
</body>
</html>
