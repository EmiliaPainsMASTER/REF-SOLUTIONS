<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Purchase</title>
    <link rel="stylesheet" href="../../public/assets/css/main.css">
    <link rel="stylesheet" href="../../public/assets/css/layout.css">
</head>
<?php
require "../../DBtoPages/common.php";
require_once '../../DBtoPages/DBconnect.php';
require_once '../../DBtoObjects/Purchase.php';

if (isset($_POST['submit'])) {
    try {
        $purchase = Purchase::loadFromDB($_POST['id'], $connection);
        $purchase->setPurchaseTotal($_POST['PurchaseTotal']);
        $purchase->setPurchaseDate($_POST['PurchaseDate']);
        $purchase->setPurchaseQuantity($_POST['PurchaseQuantity']);
        if ($purchase->updateDB($connection)) {
            header("Location: update.php");
            exit;
        }
    } catch (PDOException $error) {
        echo $error->getMessage();
    }
}

if (isset($_GET['id'])) {
    $purchase = Purchase::loadFromDB($_GET['id'], $connection);
} else {
    echo "Something went wrong!";
    exit;
}
?>
<body>
<section>
    <h2 class="title">Edit a Purchase</h2>

    <div class="container">
        <form method="post" action="update-single.php">
            <input type="hidden" name="id" value="<?php echo $purchase->getPurchaseID(); ?>">
            <label for="PurchaseTotal">Purchase Total</label>
            <input type="text" id="PurchaseTotal" name="PurchaseTotal" value="<?php echo $purchase->getPurchaseTotal(); ?>">

            <label for="PurchaseDate">Purchase Date</label>
            <input type="date" id="PurchaseDate" name="PurchaseDate" value="<?php echo $purchase->getPurchaseDate(); ?>">

            <label for="PurchaseQuantity">Purchase Quantity</label>
            <input type="number" id="PurchaseQuantity" name="PurchaseQuantity" value="<?php echo $purchase->getPurchaseQuantity(); ?>">

            <input type="submit" name="submit" value="Submit">
        </form>
    </div>
    <a href="update.php">Back to Purchases List</a>
</section>
</body>
</html>