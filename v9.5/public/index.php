<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>REF Solutions</title>
    <link rel="stylesheet" href="assets/css/main.css">
    <link rel="stylesheet" href="assets/css/layout.css">
</head>
<body>
    <?php include '../templates/header.php'; ?>

    <!-- Top Product Display -->
    <section class="top-product">
        <img src="assets/img/ibm_power_systems.jpg" alt="IBM Power Systems">
        <h3>IBM Power Systems</h3>
        <p>Price: $4,000.00</p>
        <a href="product.php?brand=IBM" class="buy-button">Buy Now</a>
    </section>

    <!-- Brand Images -->
    <section class="brands">
        <a href="product.php?brand=HP">
            <img src="assets/img/hp.png" alt="HP">
        </a>
        <a href="product.php?brand=Cisco">
            <img src="assets/img/cisco.jpeg" alt="Cisco">
        </a>
        <a href="product.php?brand=Asus">
            <img src="assets/img/asus.jpeg" alt="Asus">
        </a>
    </section>

    <!-- Go to Product Page Button -->
    <div class="product-page-btn">
        <a href="product.php">Show all Products</a>
    </div>

    <?php include '../templates/footer.php'; ?>
</body>
</html>
