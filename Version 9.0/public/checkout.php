<?php
require_once '../templates/header.php';

if (empty($_SESSION['cart'])) {
    header('Location: product.php');
    exit();
}
?>

    <link rel="stylesheet" href="assets/css/main.css">
    <link rel="stylesheet" href="assets/css/layout.css">
<section class="checkout-container">
    <h2>Checkout</h2>
    
    <form method="post" action="process_checkout.php">
        <h3>Shipping Information</h3>
        <div class="form-group">
            <label for="name">Full Name:</label>
            <input type="text" id="name" name="name" required>
        </div>
        
        <div class="form-group">
            <label for="address">Address:</label>
            <input type="text" id="address" name="address" required>
        </div>
        
        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>
        </div>
        
        
        
        <button type="submit" class="button">Complete Purchase</button>
    </form>
</section>

<?php require_once '../templates/footer.php'; ?>