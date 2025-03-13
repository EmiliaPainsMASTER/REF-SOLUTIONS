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
        include 'src/DBconnect.php';
        $sql = "SELECT * FROM products";
        $result = mysqli_query($conn, $sql);
        $productA = new readProductsClassObject();
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                $productA->productID = $row['productID'];
                $productA->productName = $row['productName'];
                $productA->productPrice = $row['productPrice'];
                $productA->productDesc = $row['productDesc'];
                $productA->productImage = $row['productImage'];
                $productA->displayProducts();
            }
        }
        else{
            echo "0 results";
        }
        ?>
    </section>
    <?php include 'footer.php'?>
</body>
</html>