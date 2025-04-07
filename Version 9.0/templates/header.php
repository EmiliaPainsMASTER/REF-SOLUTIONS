<header class="navbar">
    <a href="../public/index.php">Home</a>
    <a href="../public/about.php">About Us</a>
    <a href="../public/product.php">Buy Products</a>
    <a href="../old/sell.php">Sell Products</a>
    <a href="../public/history.php">History Items</a>
    <a href="../public/Login.php">Login</a>
    <a href="../public/cart_view.php">
        <img src="../public/assets/img/cart.png" alt="Shopping Cart">
        <?php 
        session_start();
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