<?php
session_start();
require_once '../src/Core/Database/DBconnect.php'; 

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php'); 
    exit();
}

try {
    if (isset($_POST['cancel_transaction'])) {
         
        header('Location: checkout.php');
        exit();
    }

    if (isset($_POST['confirm_transaction'])) {
        $purchaseData = $_SESSION['purchase_data'];
        $userId = $purchaseData['user_id'];
        $total = $purchaseData['total'];
        $qty = $purchaseData['qty'];

        $sql = "INSERT INTO purchases (AccountID, Total, Quantity, Date) 
                VALUES (:user_id, :total, :quantity, :purchase_date)";
        $stmt = $connection->prepare($sql);
        $stmt->bindParam(':user_id', $userId);
        $stmt->bindParam(':total', $total);
        $stmt->bindParam(':quantity', $qty);
        $stmt->bindParam(':purchase_date', date('Y-m-d'));
        $stmt->execute();

        //getting last inserted PurchaseID
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

        //cart clear
        $_SESSION['cart'] = [];
        $_SESSION['cart_count'] = 0;

        header('Location: last.php');
        exit();
    }
} catch (Exception $e) {
    $_SESSION['message'] = "Error: " . $e->getMessage();
    header('Location: checkout.php');
    exit();
}
?>

<p>Your purchase is almost complete. Please confirm or cancel the transaction.</p>

<form method="POST">
    <button type="submit" name="confirm_transaction">Confirm Transaction</button> <!-- Confirm transaction -->
    <button type="submit" name="cancel_transaction" onclick="return confirm('Are you sure you want to cancel this transaction?');">Cancel Transaction</button> 
</form>
