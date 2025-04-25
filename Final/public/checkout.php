<?php
session_start();
require_once '../src/Core/Database/DBconnect.php'; 
require_once '../src/Models/Purchase.php';

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php'); // Redirect to login if not logged in
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    try {
        // Retrieve user info
        $userId = $_SESSION['user_id'];

        // Calculate the total price and quantity of items in the cart
        $total = 0;
        $qty = 0;

        foreach ($_SESSION['cart'] as $id => $item) {
            $qty += $item['quantity'];
            $total += $item['product']['price'] * $item['quantity'];
        }

        // Step 1: Insert purchase record into 'purchases' table
        $sql = "INSERT INTO purchases (AccountID, Total, Quantity, Date) 
                VALUES (:user_id, :total, :quantity, :purchase_date)";
        $stmt = $connection->prepare($sql);
        $stmt->bindParam(':user_id', $userId);
        $stmt->bindParam(':total', $total);
        $stmt->bindParam(':quantity', $qty);
        $stmt->bindParam(':purchase_date', date('Y-m-d'));
        $stmt->execute();

        // Step 2: Get the last inserted PurchaseID
        $purchaseId = $connection->lastInsertId();

        // Step 3: Insert products into 'purchase_products' table
        foreach ($_SESSION['cart'] as $productId => $item) {
            $product = $item['product'];
            $quantity = $item['quantity'];
            $price = $product['price'];

            $sql = "INSERT INTO purchase_products (PurchaseID, ProductID, Quantity, Price) 
                    VALUES (:purchase_id, :product_id, :quantity, :price)";
            $stmt = $connection->prepare($sql);
            $stmt->bindParam(':purchase_id', $purchaseId);
            $stmt->bindParam(':product_id', $productId);
            $stmt->bindParam(':quantity', $quantity);
            $stmt->bindParam(':price', $price);
            $stmt->execute();
        }

        // Step 4: Clear the cart after purchase
        $_SESSION['cart'] = [];
        $_SESSION['cart_count'] = 0;

        // Redirect to the thanks page
        header('Location: thanks.php');
        exit();

    } catch (Exception $e) {
        $_SESSION['message'] = "Error: " . $e->getMessage();
        header('Location: checkout.php'); // Go back to checkout if an error occurs
        exit();
    }
}
?>


<!-- Checkout Form with Radio Buttons for Payment Method and Back Button -->
<form action="checkout.php" method="POST">
    <h2>Complete Purchase</h2>
    
    <label>Choose Payment Method:</label><br>
    <input type="radio" id="visa" name="payment_method" value="Visa" required>
    <label for="visa">Visa</label><br>
    <input type="radio" id="credit_card" name="payment_method" value="Credit Card" required>
    <label for="credit_card">Credit Card</label><br><br>

    <button type="submit" name="complete_purchase">Complete Purchase</button>
    <br><br>
    
    <!-- Back Button -->
    <button type="button" onclick="window.location.href='cart_view.php';">Back to Cart</button>
</form>
