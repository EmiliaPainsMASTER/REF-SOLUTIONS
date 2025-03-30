<?php
include BASE_PATH . 'src/Models/Product.php';
include BASE_PATH . 'src/Core/Database/DBconnect.php';

if (isset($_GET['query'])) {
    $searchQuery = trim($_GET['query']);

    $sql = "SELECT * FROM products WHERE ProductName LIKE :query OR ProductDesc LIKE :query";
    $stmt = $connection->prepare($sql);
    $likeQuery = "%$searchQuery%";
    $stmt->bindParam(':query', $likeQuery, PDO::PARAM_STR);
    $stmt->execute();
    
    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $products = array();

    foreach ($rows as $row) {
        $products[] = Product::getProductsClassObject($row);
    }
} else {
    $products = [];
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search Results</title>
    <link rel="stylesheet" href="assets/css/layout.css">
    <link rel="stylesheet" href="assets/css/main.css">
</head>
<body>
<?php include BASE_PATH . 'templates/header.php'; ?>

<section>
    <div class="contain_product">
        <?php
        if (count($products) > 0) {
            foreach ($products as $product) {
                $product->displayProducts();
            }
        } else {
            echo "<p>No products found for '<strong>" . htmlspecialchars($searchQuery) . "</strong>'</p>";
        }
        ?>
    </div>
</section>

<?php include BASE_PATH . 'templates/footer.php'; ?>
</body>
</html>
