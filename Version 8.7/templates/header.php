<?php
include '../baseDirDefine.php'
?>

<header class="navbar">
    <a href="../public/index.php">Home</a>
    <a href="../public/about.php">About Us</a>
    <a href="../public/product.php"> Buy Products</a>
    <a href="../public/history.php">History Items</a>
    <a href="../public/Login.php">Login</a>
    <form class="searchbar" action="../public/search.php" method="GET">
        <label>
            <input type="text" name="query" placeholder="Search.." required>
        </label>
    </form>
</header>