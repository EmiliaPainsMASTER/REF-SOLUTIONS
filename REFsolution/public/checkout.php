<?php 
session_start();
require_once '../src/Core/Database/DBconnect.php'; 
require_once '../src/Models/Purchase.php';

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php'); 
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['complete_purchase'])) {
    try {
        $userId = $_SESSION['user_id'];

        $total = 0;
        $qty = 0;

        foreach ($_SESSION['cart'] as $id => $item) {
            $qty += $item['quantity'];
            $total += $item['product']['price'] * $item['quantity'];
        }

        if ($total > 10000) {
            $_SESSION['message'] = 'Your purchase is more than €10,000. Please remove some items.';
            header('Location: cart_view.php');
            exit();
        }

        $_SESSION['purchase_data'] = [
            'user_id' => $userId,
            'total' => $total,
            'qty' => $qty,
            'date' => date('Y-m-d')
        ];

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
    
    <button type="button" onclick="window.location.href='cart_view.php';">Back to Cart</button>
</form>
