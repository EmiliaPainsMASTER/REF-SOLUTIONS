<?php
session_start();
require_once '../src/Core/Database/DBconnect.php'; // DB connection
require_once '../src/Models/Product.php'; // Product model

if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_SESSION['cart'])) {
    try {
        $name = $_POST['name'];
        $address = $_POST['address'];
        $email = $_POST['email'];

        // 1. Insert order details
        $stmt = $connection->prepare("INSERT INTO orders (CustomerName, Address, Email) VALUES (:name, :address, :email)");
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':address', $address);
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        $orderID = $connection->lastInsertId();

        // 2. Insert each product in cart
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

        // 3. Clear the cart
        $_SESSION['cart'] = [];
        $_SESSION['cart_count'] = 0;

    } catch (Exception $e) {
        $_SESSION['message'] = "Error processing order: " . $e->getMessage();
    }
} else {
    header('Location: login.php');
    exit();
}
?>

<?php require_once '../templates/header.php'; ?>
<link rel="stylesheet" href="assets/css/main.css">
<section class="thankyou-container">
    <h2>Order Confirmation</h2>
    <p><?= $_SESSION['message'] ?? 'Thank you!' ?></p>
</section>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Full Screen Image</title>
  <style>
    body, html {
      margin: 0;
      padding: 0;
      height: 100%;
      font-family: Arial, sans-serif;
    }

    .thanks_img {
      position: relative;
      height: 100%;
    }

    .thanks_img img {
      width: 100%;
      height: 100%;
      object-fit: cover;
    }

    .back-button {
      position: absolute;
      bottom: 30px;
      left: 47%;
      padding: 12px 30px;
      font-size: 18px;
      color: white;
      background-color: red;
      text-decoration: none;
      border-radius: 8px;
      box-shadow: 0 4px 8px rgba(0,0,0,0.3);
    }

    .back-button:hover {
      background-color: darkred;
    }
  </style>
</head>
<body>

  <div class="thanks_img">
    <a class="back-button" href="index.php">H O M E</a>
    <img src="assets/img/thanks.jpg" alt="Full Screen Image">
  </div>

</body>
</html>
