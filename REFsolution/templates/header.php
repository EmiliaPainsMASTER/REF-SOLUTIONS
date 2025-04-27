<header class="navbar">

    <!-- Hamburger Section -->
    <div class="hamburger-wrapper">
        <input type="checkbox" id="hamburger-toggle" class="hamburger-checkbox">
        <label for="hamburger-toggle" class="hamburger">
            <img src="../public/assets/img/hamburger.png" alt="Menu" class="hamburger-icon">
        </label>
        <div class="hamburger-menu">
            <a href="../public/about.php">About Us</a>
            <a href="../public/sell.php">Sell Products</a>
            <a href="../public/history.php">History Items</a>
            <a href="../public/admin_login.php">Admin Login</a>
        </div>
    </div>

    <!-- Left navigation -->
    <a href="../public/index.php">Home</a>
    <a href="../public/product.php">Buy Products</a>
    <?php if (isset($_SESSION['user_name'])): ?>
    <span class="logged-user">Welcome <?= $_SESSION['user_name']; ?></span>
    <a href="../public/logout.php">Log Out</a>
        <?php else: ?>
            <a href="../public/Login.php">Login</a>
        <?php endif; ?>


    <!-- Cart Icon -->
    <a href="../public/cart_view.php" class="cart-link">
        <img src="../public/assets/img/cart.png" alt="Shopping Cart">
        <?php 
        if (!empty($_SESSION['cart'])) {
            $count = count($_SESSION['cart']);
            echo "<span class='cart-count'>$count</span>";
        }
        ?>
    </a>

    <!-- Search -->
    <form class="searchbar" action="../public/search.php" method="GET">
        <input type="text" name="query" placeholder="Search.." required>
    </form>

</header>
