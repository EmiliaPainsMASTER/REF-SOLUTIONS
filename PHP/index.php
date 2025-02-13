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
        <a href="search.php">Search</a>
        <a href="product.php">Products</a>
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