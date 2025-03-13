<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="css/refSolution.css">
    <link rel="stylesheet" href="css/layout.css">
    <title>Products</title>
</head>
<body>
    <?php include 'header.php'; ?>
    <section>
        <?php
        include 'src/DBconnect.php'; // This uses PDO

        $sql = "SELECT * FROM products";
        $stmt = $connection->query($sql); // Use PDO query
        $products = $stmt->fetchAll(PDO::FETCH_ASSOC); // Fetch all results

        $productA = new readProductsClassObject();
        if (count($products) > 0) {
            foreach ($products as $row) {
                $productA->productID = $row['productID'];
                $productA->productName = $row['productName'];
                $productA->productPrice = $row['productPrice'];
                $productA->productDesc = $row['productDesc'];
                $productA->productImage = $row['productImage'];
                $productA->displayProducts();
            }
        } else {
            echo "0 results";
        }
        ?>
    </section>
    <?php include 'footer.php'?>
</body>
</html>