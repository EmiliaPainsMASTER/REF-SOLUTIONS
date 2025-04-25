<?php
session_start();
require_once '../src/Core/Database/DBconnect.php'; 
require_once '../src/Models/Purchase.php';

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php'); // Redirect to login if not logged in
    exit();
}

try {
    // If cancel button is clicked, redirect back to the cart page
    if (isset($_POST['cancel_transaction'])) {
        unset($_SESSION['purchase_data']);  // Clear purchase data
        $_SESSION['cart'] = [];  // Clear the cart
        $_SESSION['cart_count'] = 0;  // Reset cart count
        header('Location: cart_view.php');
        exit();
    }

    // If confirm button is clicked, insert the data into the database
    if (isset($_POST['confirm_transaction'])) {
        // Retrieve purchase data from the session
        $purchaseData = $_SESSION['purchase_data'];
        $userId = $purchaseData['user_id'];
        $total = $purchaseData['total'];
        $qty = $purchaseData['qty'];

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

        // Step 3: Insert products into the 'purchase_products' table
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

        // Step 4: Clear the cart and reset cart count
        $_SESSION['cart'] = [];
        $_SESSION['cart_count'] = 0;

        // Clear purchase data from session
        unset($_SESSION['purchase_data']);

        // Redirect to the home page or a confirmation page
        header('Location: index.php');
        exit();
    }
} catch (Exception $e) {
    $_SESSION['message'] = "Error: " . $e->getMessage();
    header('Location: cart_view.php');
    exit();
}
?>

<h2>Thank you for your purchase!</h2>
<p>Your purchase is almost complete. Please confirm or cancel the transaction.</p>

<!-- Confirm and Cancel buttons -->
<form method="POST">
    <button type="submit" name="confirm_transaction">Confirm Transaction</button> <!-- Confirm transaction -->
    <button type="submit" name="cancel_transaction" onclick="return confirm('Are you sure you want to cancel this transaction?');">Cancel Transaction</button> <!-- Cancel transaction -->
</form>
