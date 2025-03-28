<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Products Page</title>
    <link rel="stylesheet" href="css/layout.css">
    <link rel="stylesheet" href="css/main.css">
</head>
<body>
<?php include 'templates/header.php'; ?>
<section>
    <div class="contain_product">
        <?php
        include 'DBtoObjects/ProductsClassObject.php';
        include 'DBtoPages/DBconnect.php';

        $products = ProductsClassObject::loadAllFromDB($connection);

        if (count($products) > 0) {
            foreach ($products as $product) {
                $product->displayProducts();
            }
            echo "<p>Total Products: " . count($products) . "</p>";
        } else {
            echo "<p>No products found!</p>";
        }
        ?>
    </div>
</section>
<?php include 'templates/footer.php'; ?>
</body>
</html>
