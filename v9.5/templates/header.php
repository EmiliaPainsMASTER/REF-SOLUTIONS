<header class="navbar">

    <!-- Hamburger Section: group checkbox, label and menu together -->
    <div class="hamburger-wrapper">
        <input type="checkbox" id="hamburger-toggle" class="hamburger-checkbox">
        <label for="hamburger-toggle" class="hamburger">
            <img src="../public/assets/img/hamburger.png" alt="Menu" class="hamburger-icon">
        </label>
        <div class="hamburger-menu">
            <a href="../public/about.php">About Us</a>
            <a href="../old/sell.php">Sell Products</a>
            <a href="../public/history.php">History Items</a>
        </div>
    </div>

    <!-- Other navigation links -->
    <a href="../public/index.php">Home</a>
    <a href="../public/product.php">Buy Products</a>
    <a href="../public/Login.php">Login</a>

    <a href="../public/cart_view.php">
        <img src="../public/assets/img/cart.png" alt="Shopping Cart">
        <?php 
        if (!empty($_SESSION['cart'])) {
            $count = count($_SESSION['cart']);
            echo "<span class='cart-count'>$count</span>";
        }
        ?>
    </a>

    <form class="searchbar" action="../public/search.php" method="GET">
        <input type="text" name="query" placeholder="Search.." required>
    </form>

</header>
