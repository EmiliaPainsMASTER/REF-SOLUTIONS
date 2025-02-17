<?php 
$productArray = array("cisco_ucs","dell_poweredge","hpe_proliant","ibm_power_systems","lenovo_thinksystem");
?>
<!DOCTYPE html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>REF Solutions</title>
    <link rel="stylesheet" href="css/index.css">
    <link rel="stylesheet" href="css/main.css">
    <link rel="stylesheet" href="css/css.css">
</head>
<body>
    <div class="gridContainer">
        <header class="headerGrid">
            <div class="topnav">
                <a href="index.php">Home</a>
                <a href="About.php">About Us</a>
                <a href="product.php"> Buy Products</a>
                <a href="sell.html">Sell Products</a>
                <a href="history.php">History Items</a>
                <a href="Login.php">Login</a>
                <a href="Register.php">Register</a>
                <form class="searchbar" action="">
                    <input type="text" placeholder="Search..">
                </form>
            </div>
        </header>
        <section class="topGrid">
            <h2>Our Top Five best sellers!</h2>
        </section>
        <section class="MidGrid">
            <div class="product" id="product2">
            <?php 
                for ($count = 0; $count <= 4; $count++) {
                    echo '<img src="img/' . $productArray[$count] . '.jpg">';
            }?>
            </div>
        </section>
        <footer class="footerGrid">
            <p class="pIndex">Copyright © REF Solutions</p>
        </footer>
    </div>
</body>
</html>