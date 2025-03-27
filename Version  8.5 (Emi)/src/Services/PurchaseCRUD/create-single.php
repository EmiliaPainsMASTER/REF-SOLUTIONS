<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Purchase Form</title>
    <link rel="stylesheet" href="../../public/assets/css/main.css">
    <link rel="stylesheet" href="../../public/assets/css/layout.css">
</head>
<?php require "../../templates/header.php"; ?>
<?php
require "../../DBtoPages/common.php";
require_once '../../DBtoPages/DBconnect.php';
require_once '../../DBtoObjects/Purchase.php';
if (isset($_POST['submit'])) {
    try {
        $purchase = new Purchase();
        $purchase->setPurchaseTotal($_POST['PurchaseTotal']);
        $purchase->setPurchaseDate($_POST['PurchaseDate']);
        $purchase->setPurchaseQuantity($_POST['PurchaseQuantity']);
        if ($purchase->insertDB($connection)) {
            header("Location: ../../index.php");
            exit;
        }
    } catch (Exception $e) {
        echo $e->getMessage();
    }
}
?>
<body>
<section>
    <h2 class="title">Create a New Purchase</h2>

    <div class="container">
        <form method="post" action="create-single.php">
            <label for="PurchaseTotal">Purchase Total</label>
            <input type="text" name="PurchaseTotal" id="PurchaseTotal" placeholder="Purchase Total">

            <label for="PurchaseDate">Purchase Date</label>
            <input type="date" name="PurchaseDate" id="PurchaseDate" placeholder="Purchase Date">

            <label for="PurchaseQuantity">Purchase Quantity</label>
            <input type="number" name="PurchaseQuantity" id="PurchaseQuantity" placeholder="Purchase Quantity">

            <input type="submit" name="submit" value="Submit">
        </form>
    </div>
    <a href="../../public/index.php">Back to Purchases List</a>
</section>
<?php require "../../templates/footer.php"; ?>
</body>
</html>