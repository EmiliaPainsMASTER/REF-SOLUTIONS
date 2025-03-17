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
<?php include 'templates/header.php' ?>
<section>
    <div class="products-container">
        <?php
        include 'DBtoObjects/ProductsClassObject.php';
        include 'DBtoPages/DBconnect.php';

        $sql = "SELECT * FROM products";
        $stmt = $connection->query($sql);
        $products = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $productA = new ProductsClassObject();
        if (count($products) > 0) {
            foreach ($products as $row) {
                $productA->productID = $row['ProductID'];
                $productA->productPrice = $row['Price'];
                $productA->productImage = $row['Image'];
                $productA->productName = $row['ProductName'];
                $productA->productDesc = $row['ProductDesc'];
                $productA->displayProducts();
            }
            echo "<br>--------------------------------------------------------------------------";
            echo "<p>Total Products: " . count($products) . "</p>";
        } else {
            echo "<p>No products found!</p>";
        }
        ?>
    </div>
</section>
<?php include 'templates/footer.php' ?>
</body>
</html>