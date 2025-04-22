<?php
session_start();
require_once '../src/Core/Database/DBconnect.php'; 
require_once '../src/Models/Product.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_SESSION['cart'])) {
    try {
        $name = $_POST['name'];
        $address = $_POST['address'];
        $email = $_POST['email'];

        //Insert order
        $stmt = $connection->prepare("INSERT INTO orders (CustomerName, Address, Email) VALUES (:name, :address, :email)");
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':address', $address);
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        $orderID = $connection->lastInsertId();

        //Insert each product in cart
        $stmtItem = $connection->prepare("INSERT INTO order_items (OrderID, ProductID, Quantity, Price) VALUES (:orderID, :productID, :quantity, :price)");

        foreach ($_SESSION['cart'] as $productId => $item) {
            $product = $item['product'];
            $quantity = $item['quantity'];
            $price = $product['price'];

            $stmtItem->bindParam(':orderID', $orderID);
            $stmtItem->bindParam(':productID', $productId);
            $stmtItem->bindParam(':quantity', $quantity);
            $stmtItem->bindParam(':price', $price);
            $stmtItem->execute();
        }

        //Clear cart
        $_SESSION['cart'] = [];
        $_SESSION['cart_count'] = 0;
        $_SESSION['message'] = "Thank you for your purchase! Order #$orderID has been placed.";

    } catch (Exception $e) {
        $_SESSION['message'] = "Error processing order: " . $e->getMessage();
    }
} else {
    header('Location: login.php');
    exit();
}
?>


<link rel="stylesheet" href="assets/css/main.css">
<link rel="stylesheet" href="assets/css/thanks.css">


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <style>
    
  </style>
</head>
<body>

  <div class="thanks_img">
    <a class="back-button" href="index.php">H O M E</a>
    <img src="assets/img/thanks.jpg" alt="Thanks Image">
  </div>

<?php require_once '../templates/footer.php'; ?>
</body>
</html>
