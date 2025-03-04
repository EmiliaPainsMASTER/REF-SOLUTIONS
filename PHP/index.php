<?php 
$productArray = array("cisco_ucs","dell_poweredge","hpe_proliant","ibm_power_systems","lenovo_thinksystem");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>REF Solutions</title>
    <link rel="stylesheet" href="css/refSolution.css">
    <link rel="stylesheet" href="css/layout.css">
</head>
<body>
<div class="navbar">
    <a href="index.php">Home</a>
    <a href="about.php">About Us</a>
    <a href="product.php"> Buy Products</a>
    <a href="sell.php">Sell Products</a>
    <a href="history.php">History Items</a>
    <a href="Login.php">Login</a>
    <a href="Register.php">Register</a>
    <form class="searchbar" action="">
        <input type="text" placeholder="Search..">
    </form>
</div>
        <section>
            <h2>Our Top Five best sellers!</h2>
        </section>
        <section>
            <div class="product" id="product2">
            <?php 
                for ($count = 0; $count <= 4; $count++) {
                    echo '<img src="img/' . $productArray[$count] . '.jpg">';
            }?>
            </div>
        </section>
        <footer>
            <p>&copy; <?php echo date('Y'); ?> REF Solutions.</p>
        </footer>
</body>
</html>