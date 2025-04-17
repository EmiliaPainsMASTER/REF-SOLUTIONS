<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Products Page</title>
    <link rel="stylesheet" href="assets/css/main.css">
</head>
<body>
<?php 
    session_start();
    include '../templates/header.php'; 
    include '../src/Models/Product.php';
    include '../src/Core/Database/DBconnect.php';
?>

<!-- Back Button -->
<div style="margin: 20px;">
    <a href="index.php" style="padding: 10px 20px; background-color: #ccc; border-radius: 5px; text-decoration: none; color: black; font-weight: bold;">
        ← Back
    </a>
</div>

<section>
    <div class="contain_product">
        <?php
        $products = [];

        if (isset($_GET['brand']) && !empty($_GET['brand'])) {
            // Filter products by brand
            $brand = trim($_GET['brand']);
            $sql = "SELECT * FROM products WHERE ProductName LIKE :brand OR ProductDesc LIKE :brand";
            $stmt = $connection->prepare($sql);
            $likeBrand = "%$brand%";
            $stmt->bindParam(':brand', $likeBrand, PDO::PARAM_STR);
            $stmt->execute();

            $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
            foreach ($rows as $row) {
                $products[] = Product::getProductsClassObject($row);
            }

            echo "<h2>Showing products for brand: <strong>" . htmlspecialchars($brand) . "</strong></h2>";

        } else {
            // Load all products
            $products = Product::loadAllFromDB($connection);
            echo "<h2>All Products</h2>";
        }

        // Display products
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

<?php include '../templates/footer.php'; ?>
</body>
</html>
