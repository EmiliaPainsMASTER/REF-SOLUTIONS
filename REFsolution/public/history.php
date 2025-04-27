<?php
session_start();
require_once '../src/Core/Database/DBconnect.php';
require_once '../src/Models/Purchase.php';

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

// Get user purchases
$userId = $_SESSION['user_id'];
$purchases = Purchase::loadAllFromDBForUser($connection, $userId);
?>

<!DOCTYPE html>
<html>
<head>
    <title>My Orders</title>
    <link rel="stylesheet" href="assets/css/main.css">
</head>
<body>

<?php include '../templates/header.php' ?>

<div class="container">
    <h1 class="title">My Orders</h1>

    <?php if (empty($purchases)): ?>
        <p class="no-orders">You haven't placed any orders yet.</p>
    <?php else: ?>
        <div class="contain_product">
            <?php foreach ($purchases as $purchase): ?>
                <div class="productdisplay">
                    <p><strong>Date:</strong> <?= $purchase->getPurchaseDate() ?></p>
                    <p><strong>Total:</strong> €<?= $purchase->getPurchaseTotal() ?></p>
                    <p><strong>Items:</strong> <?= $purchase->getPurchaseQuantity() ?></p>
                </div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
</div>

<?php include '../templates/footer.php' ?>

</body>
</html>