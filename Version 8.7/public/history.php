<?php
session_start();
include '../templates/header.php';
require_once BASE_PATH . 'src/Core/Database/DBconnect.php';
require_once BASE_PATH . 'src/Models/Product.php';
require_once BASE_PATH . 'src/Models/Purchase.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>History Items Purchased</title>
    <link rel="stylesheet" href="assets/css/main.css">
    <link rel="stylesheet" href="assets/css/layout.css">
</head>
<body>
    <section>
        <h2 class="title">History of Purchased Items</h2>
        <div class="container">
            <?php
            if (isset($_SESSION['userID'])) {
                $userId = $_SESSION['userID'];
                $purchases = Purchase::loadUserPurchases($userId, $connection);
                if (!empty($purchases)) {
                    echo '<div class="purchase-history">';
                    foreach ($purchases as $purchase) {
                        $product = Product::loadFromDB($purchase->getProductID(), $connection);
                        $purchase->displayPurchases($product);
                    }
                    echo '</div>';
                } else {
                    echo '<p>No items purchased yet.</p>';
                }
            } else {
                echo '<p>Please <a href="Login.php">login</a> to view your purchase history.</p>';
            }
            ?>
        </div>
    </section>
    <?php include BASE_PATH . 'templates/footer.php' ?>
</body>
</html>
