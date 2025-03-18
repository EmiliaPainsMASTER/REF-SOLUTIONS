<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create product form</title>
    <link rel="stylesheet" href="../../css/main.css">
    <link rel="stylesheet" href="../../css/layout.css">
</head>
<?php require "../../templates/header.php"; ?>
<?php
require "../../DBtoPages/common.php";
require_once '../../DBtoPages/DBconnect.php';
require_once '../../DBtoObjects/ProductsClassObject.php';
if (isset($_POST['submit'])) {
    try {
        $product = new ProductsClassObject();
        $product->setProductPrice($_POST['ProductPrice']);
        $product->setProductImage($_POST['ProductImage']);
        $product->setProductName($_POST['ProductName']);
        $product->setProductDesc($_POST['ProductDesc']);
        if ($product->insertDB($connection)){
            header("Location: ../product.php");
            exit;
        }
        else{
            echo "Something went wrong between lines 15-21";
        }
    }
    catch (Exception $e) {
        echo $e->getMessage();
    }
}
?>
<body>
<section>
    <h2 class="title">Create a Product</h2>

    <div class="container">
        <form method="post" action="create-single.php">
            <label for="ProductPrice">Product Price</label>
            <input type="text" name="ProductPrice" id="ProductPrice" placeholder="Product Price">

            <label for="ProductImage">Product Image</label>
            <input type="text" name="ProductImage" id="ProductImage" placeholder="Product Image">

            <label for="ProductName">Product Name</label>
            <input type="text" name="ProductName" id="ProductName" placeholder="Product Name">

            <label for="ProductDesc">Product Description</label>
            <textarea name="ProductDesc" id="ProductDesc" cols="30" rows="10" placeholder="Product Description"></textarea>

            <input type="submit" name="submit" value="Submit">
        </form>
    </div>
    <a href="../../product.php">Back to Products List</a>
</section>
<?php require "../../templates/footer.php"; ?>
</body>
</html>