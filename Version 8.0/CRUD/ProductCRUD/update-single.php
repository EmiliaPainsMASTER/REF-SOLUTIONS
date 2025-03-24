<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update product form</title>
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
        $product = ProductsClassObject::loadFromDB($_POST['id'], $connection);
        $product->setProductName($_POST['ProductName']);
        $product->setProductPrice($_POST['ProductPrice']);
        $product->setProductDesc($_POST['ProductDesc']);
        if ($product->updateDB($connection)){
            header("Location: update.php");
            exit;
        }
        else{
            echo "Something went wrong between lines 15-21!";
        }
    } catch (PDOException $error) {
        echo $error->getMessage();
    }
}

if (isset($_GET['id'])) {
    $product = ProductsClassObject::loadFromDB($_GET['id'], $connection);
} else {
    echo "Something went wrong between lines 32-35!";
    exit;
}

?>
<body>
<section>
    <h2 class="title">Edit a Product</h2>

    <div class="container">
        <form method="post" action="update-single.php">
            <input type="hidden" name="id" value="<?php echo $product->getProductId(); ?>">
            <label for="ProductName">Product Name</label>
                <input type="text" id="ProductName" name="ProductName" value="<?php echo $product->getProductName(); ?>">

            <label for="ProductPrice">Product Price</label>
            <input type="text" id='ProductPrice' name="ProductPrice" value="<?php echo $product->getProductPrice(); ?>">

            <label for="ProductDesc">Product Description</label>
            <textarea name="ProductDesc" id="ProductDesc" rows="5" cols="30"><?php echo $product->getProductDesc(); ?>
            </textarea>

            <input type="submit" name="submit" value="Submit">
        </form>
    </div>
    <a href="update.php">Back to Products List</a>
</section>
<?php require "../../templates/footer.php"; ?>
</body>
</html>