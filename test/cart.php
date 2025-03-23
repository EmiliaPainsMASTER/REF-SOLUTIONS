<?php
session_start();

if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $product_id = $_POST['product_id'];
    $quantity = intval($_POST['quantity']);

    if (isset($_POST['increase'])) {
        $quantity++;
    } elseif (isset($_POST['decrease']) && $quantity > 1) {
        $quantity--;
    }

    $_SESSION['cart'][$product_id] = $quantity;

    header("Location: product.php");
    exit();
}
?>
