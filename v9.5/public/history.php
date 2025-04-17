<?php
session_start();
require_once '../src/Core/Database/DBconnect.php';
require_once '../src/Models/User.php';

// Get logged in user
$user = null;
if (isset($_SESSION['user_id'])) {
    $user = User::loadFromDB($_SESSION['user_id'], $connection);
}

// Get user's orders
$orders = [];
if ($user) {
    $email = $user->getEmail(); // Store email in variable first
    $sql = "SELECT o.OrderID, oi.ProductID, oi.Quantity, oi.Price, p.ProductName 
            FROM orders o
            JOIN order_items oi ON o.OrderID = oi.OrderID
            JOIN products p ON oi.ProductID = p.ProductID
            WHERE o.Email = :email
            ORDER BY o.OrderID DESC";
    
    $stmt = $connection->prepare($sql);
    $stmt->bindParam(':email', $email); // Now passing variable reference
    $stmt->execute();
    $orders = $stmt->fetchAll(PDO::FETCH_ASSOC);
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>My Orders</title>
    
<link rel="stylesheet" href="assets/css/main.css">
</head>
<body>

<?php include '../templates/header.php' ?>

<h2>My Orders</h2>

<?php if (empty($orders)): ?>
    <p>You haven't placed any orders yet.</p>
<?php else: ?>
    <?php
    $currentOrderId = null;
    foreach ($orders as $item):
        if ($currentOrderId != $item['OrderID']):
            $currentOrderId = $item['OrderID'];
    ?>
            
        <?php endif; ?>
        
        <div class="order-item">
            <?= htmlspecialchars($item['ProductName']) ?> - 
            <?= (int)$item['Quantity'] ?> x 
            €<?= number_format((float)$item['Price'], 2) ?>
            <br>---------------------------------------------------------------------------
        </div>
        
        
    <?php endforeach; ?>
<?php endif; ?>

<?php include '../templates/footer.php' ?>

</body>
</html>