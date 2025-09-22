
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
    <title>Ein- und Auslagern</title>
    <link rel="icon" type="image/x-icon" href="../icons/icon.png">
    <script src="https://unpkg.com/quagga@0.12.1/dist/quagga.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-LN+7fdVzj6u52u30Kp6M/trliBMCMKTyK833zpbD+pXdCLuTusPj697FH4R/5mcr" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js" integrity="sha384-ndDqU0Gzau9qJ1lfW4pNLlhNTkCfHzAVBReH9diLvGRem5+R9g2FzA8ZGN954O5Q" crossorigin="anonymous"></script>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,700;1,400&family=Montserrat:wght@300;400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../header/header.css">
    <link rel="stylesheet" href="logistics.css">
    <script src="../config/config.js"></script>
    <script src="../header/header.js"></script>
</head>
<body>
    <?php
        include "../header/header.php";
    ?>

    <br>

    <div class="edit-product-container d-flex flex-column vh-100 p-5">

        <h1 class="edit-product-header mb-5 flex-shrink-0">Logistik</h1>

        <form id="logistic-form" class="row g-4 align-items-end flex-shrink-0" onsubmit="logistics_btn_pressed(event)">

            <div class="col-12 col-md-4 form-inputs">
                <label for="logistics-name" class="form-label fs-5 fw-semibold">Name</label>
                <input type="text" id="logistics-name" name="logistics-name" class="form-control form-control-lg" placeholder="Name eingeben" required>
            </div>

            <div class="col-12 col-md-4 form-inputs position-relative">
                <label for="search-product" class="form-label fs-5 fw-semibold">Produkt suchen</label>
                <input type="search" id="search-product" name="search-product" class="form-control form-control-lg" placeholder="Produkte durchsuchen">

                <ul id="suggestions" class="list-group position-absolute w-100" style="z-index: 1050; max-height: 200px; overflow-y: auto; display: none;"></ul>
            </div>

            <div class="col-12 col-md-4 form-inputs">
                <label for="action-type" class="form-label fs-5 fw-semibold">Aktion</label>
                <select id="action-type" name="action-type" class="form-select form-select-lg" required>
                    <option value="" disabled selected>Einlagern / Auslagern</option>
                    <option value="einlagern">Einlagern</option>
                    <option value="auslagern">Auslagern</option>
                </select>
            </div>

            <div class="col-12 col-md-3 form-inputs">
                <label for="quantity" class="form-label fs-5 fw-semibold">Anzahl</label>
                <input type="number" id="quantity" name="quantity" class="form-control form-control-lg" min="1" value="1" required>
            </div>

            <div class="col-12 col-md-6 d-flex gap-3">
                <button type="button" id="open-scanner" class="btn btn-warning btn-lg flex-grow-1">Scanner öffnen</button>
                <button type="submit" id="confirm-btn" class="btn btn-success btn-lg flex-grow-1" disabled="true">Bestätigen</button>
            </div>

        </form>

        <hr class="my-3 flex-shrink-0"/>

        <h2 class="edit-product-header flex-shrink-0 mb-4">Verlauf</h2>

        <div id="logistic-history" class="flex-grow-1 overflow-auto border rounded p-3 bg-white shadow-sm">
            <ul class="list-group fs-5">
            </ul>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="logistics.js"></script>
</body>
</html>
