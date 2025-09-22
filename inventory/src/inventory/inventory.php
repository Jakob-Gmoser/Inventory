
<?php

session_start();

header("Cache-Control: no-cache, no-store, must-revalidate"); 
header("Pragma: no-cache");
header("Expires: 0");

if (!isset($_SESSION["user_id"])) {
    header("Location: ../login/login.php");
    exit;
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>Inventar</title>
    <link rel="icon" type="image/x-icon" href="../icons/icon.png">
    <script src="https://unpkg.com/quagga@0.12.1/dist/quagga.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-LN+7fdVzj6u52u30Kp6M/trliBMCMKTyK833zpbD+pXdCLuTusPj697FH4R/5mcr" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js" integrity="sha384-ndDqU0Gzau9qJ1lfW4pNLlhNTkCfHzAVBReH9diLvGRem5+R9g2FzA8ZGN954O5Q" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="../header/header.css">
    <link rel="stylesheet" href="../product_cards/product_card.css">
    <link rel="stylesheet" href="../delete_product/delete_product_overlay.css">
    <script src="../header/header.js"></script>
    <script src="../config/config.js"></script>
    <script src="../delete_product/delete_product_overlay.js"></script>
    <script src="../product_cards/add_product_cards.js"></script>
</head>
<body>
    <?php
        include "../header/header.php";
    ?>

    <?php
        include "../delete_product/delete_product_overlay.html";
    ?>

    <br>

    <div class="container" id="inventory-products"></div>
</body>
</html>

