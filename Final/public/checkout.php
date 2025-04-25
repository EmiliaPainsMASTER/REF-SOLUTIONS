<?php 
session_start();
require_once '../src/Core/Database/DBconnect.php'; 
require_once '../src/Models/Purchase.php';

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php'); 
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    try {
        $userId = $_SESSION['user_id'];

        //total price and quantity of items in the cart
        $total = 0;
        $qty = 0;

        foreach ($_SESSION['cart'] as $id => $item) {
            $qty += $item['quantity'];
            $total += $item['product']['price'] * $item['quantity'];
        }

        // Checks if its more than 10,000
        if ($total > 10000) {
            $_SESSION['message'] = 'Your purchase is more than €10,000. Please remove some items.';
            header('Location: cart_view.php');
            exit();
        }

        $sql = "INSERT INTO purchases (AccountID, Total, Quantity, Date) 
                VALUES (:user_id, :total, :quantity, :purchase_date)";
        $stmt = $connection->prepare($sql);
        $stmt->bindParam(':user_id', $userId);
        $stmt->bindParam(':total', $total);
        $stmt->bindParam(':quantity', $qty);
        $stmt->bindParam(':purchase_date', date('Y-m-d'));
        $stmt->execute();

        $purchaseId = $connection->lastInsertId();

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

        $_SESSION['cart'] = [];
        $_SESSION['cart_count'] = 0;

        header('Location: thanks.php');
        exit();

    } catch (Exception $e) {
        $_SESSION['message'] = "Error: " . $e->getMessage();
        header('Location: checkout.php'); 
        exit();
    }
}
?>

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
