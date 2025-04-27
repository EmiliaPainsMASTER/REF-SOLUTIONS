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

<div class="back_button">
    <a href="index.php" class="back_button">Back</a>
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

            echo "Showing products for brand: " . $brand . "</h2>";

        } else {
            // Load all products
            $products = Product::loadAllFromDB($connection);
            
        }

        // Display products
        if (count($products) > 0) {
            foreach ($products as $product) {
                $product->displayProducts();
            }
            
        } else {
            echo "<p>No products found!</p>";
        }
        ?>
    </div>
</section>

<?php include '../templates/footer.php'; ?>
</body>
</html>
