
<header class="header">
    <div class="header-container">
        <nav class="nav-links" role="navigation" aria-label="Hauptnavigation">
            <a href="../inventory/inventory.php" class="nav-link link-secondary" id="inventory">Inventar</a>
            <a href="../add_product/add_product.php" class="nav-link" id="open-inventory">Produkt hinzufügen</a>
            <a href="../logistics/logistics.php" class="nav-link" id="logistics">Ein- und Auslagern</a>
        </nav>

        <div class="user-menu">
            <button class="username" aria-haspopup="true" aria-expanded="false">
                <?php echo htmlspecialchars($_SESSION["username"]); ?>
            </button>
            <ul class="dropdown-menu" role="menu" aria-label="Benutzermenü">
                <li><a href="../logout/logout.php" class="dropdown-item" role="menuitem">Abmelden</a></li>
            </ul>
        </div>
    </div>
</header>
