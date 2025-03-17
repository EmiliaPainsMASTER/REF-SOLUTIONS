<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="css/refSolution.css">
    <link rel="stylesheet" href="css/layout.css">
    <title>Products</title>
</head>
<body>
    <?php include 'templates/header.php'; ?>
    <section>
        <?php
        include 'DBtoObjects/readProductsClassObject.php';
        include 'DBtoPages/DBconnect.php'; // This uses PDO

        $sql = "SELECT * FROM products";
        $stmt = $connection->query($sql); // Use PDO query
        $products = $stmt->fetchAll(PDO::FETCH_ASSOC); // Fetch all results

        $productA = new readProductsClassObject();
        if (count($products) > 0) {
            foreach ($products as $row) {
                $productA->productID = $row['ProductID'];
                $productA->productPrice = $row['Price'];
                $productA->productImage = $row['Image'];
                $productA->productName = $row['ProductName'];
                $productA->productDesc = $row['ProductDesc'];
                $productA->displayProducts();
            }
        } else {
            echo "0 results";
        }
        ?>
    </section>
    <?php include 'templates/footer.php' ?>
</body>
</html>