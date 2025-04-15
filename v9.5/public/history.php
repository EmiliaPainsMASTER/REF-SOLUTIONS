<?php
session_start();
require_once '../src/Core/Database/DBconnect.php';
require_once '../src/Models/User.php';

$orders = [];

if (isset($_SESSION['user_id'])) {
    $userID = $_SESSION['user_id'];
    $user = User::loadFromDB($userID, $connection);
    if ($user) {
        $orders = $user->getPurchaseHistory($connection);
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Purchase History</title>
</head>
    <link rel="stylesheet" href="assets/css/main.css">
<body>
<?php include '../templates/header.php' ?>

<h2>Purchase History</h2>

<?php if (!empty($orders)): ?>
    <?php foreach ($orders as $order): ?>
        <p>
            Order ID: <?= $order['OrderID'] ?><br>
            Name: <?= $order['CustomerName'] ?><br>
            Address: <?= $order['Address'] ?><br>
            Email: <?= $order['Email'] ?>
        </p>
        <hr>
    <?php endforeach; ?>
<?php else: ?>
    <p>No items purchased yet.</p>
<?php endif; ?>

<?php include '../templates/footer.php' ?>
</body>
</html>
