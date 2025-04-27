<?php
session_start();
require_once '../src/Models/Product.php'; 
require_once '../templates/header.php';
?>

<link rel="stylesheet" href="assets/css/main.css">
<section class="cart-container">
    <h2>Your Shopping Cart</h2>

    <!-- Order Limit Notice -->
    <div class="order_limit_notice">
        <strong>Note:</strong> Customers cannot order products exceeding a total of <strong>€10,000</strong>.
    </div>
    
    <?php if (isset($_SESSION['message'])): ?>
        <div class="message"><?= $_SESSION['message'] ?></div>
        <?php unset($_SESSION['message']); ?>
    <?php endif; ?>
    
    <?php 
    
    if (!empty($_SESSION['cart'])) {
        foreach ($_SESSION['cart'] as $productId => $item) {
            if (is_object($item['product']) && get_class($item['product']) === '__PHP_Incomplete_Class') {
                $_SESSION['cart'][$productId]['product'] = [
                    'id' => $item['product']->productID,
                    'name' => $item['product']->productName,
                    'price' => $item['product']->productPrice,
                    'image' => $item['product']->productImage,
                    'desc' => $item['product']->productDesc
                ];
            }
        }
    }
    
    if (empty($_SESSION['cart'])): ?>
        <p>Your cart is empty</p>
    <?php else: ?>
        <table>
            <thead>
                <tr>
                    <th>Product</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Total</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                $grandTotal = 0;
                foreach ($_SESSION['cart'] as $productId => $item): 
                    $product = $item['product'];
                    $quantity = $item['quantity'];
                
                    if (is_object($product)) {
                        $product = [
                            'name' => $product->productName ?? '',
                            'price' => $product->productPrice ?? 0,
                            'image' => $product->productImage ?? '',
                            'desc' => $product->productDesc ?? ''
                        ];
                    }
                    $total = $product['price'] * $quantity;
                    $grandTotal += $total;
                ?>
                
                <?php if (isset($_SESSION['error'])): ?>
                    <div class="alert alert-danger">
                        <?= htmlspecialchars($_SESSION['error']) ?>
                    </div>
                    <?php unset($_SESSION['error']); ?>
                <?php endif; ?>

                <tr>
                    <td>
                        <?= htmlspecialchars($product['name']) ?>
                        <?php if (!empty($product['image'])): ?>
                            <img src="../public/assets<?= htmlspecialchars($product['image']) ?>" alt="Product Image" class="cart-thumbnail">
                        <?php endif; ?>
                    </td>
                    <td>€<?= number_format($product['price'], 2) ?></td>
                    <td>
                        <form method="post" action="cart.php">
                            <input type="hidden" name="product_id" value="<?= $productId ?>">
                            <input type="hidden" name="action" value="update">
                            <input type="number" name="quantity" value="<?= $quantity ?>" min="1" class="quantity-input">
                            <button type="submit" class="update-btn">Update</button>
                        </form>
                    </td>
                    <td>€<?= number_format($total, 2) ?></td>
                    <td>
                        <form method="post" action="cart.php">
                            <input type="hidden" name="product_id" value="<?= $productId ?>">
                            <input type="hidden" name="action" value="remove">
                            <button type="submit" class="remove-btn">Remove</button>
                        </form>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="3"><strong>Grand Total</strong></td>
                    <td colspan="2">€<?= number_format($grandTotal, 2) ?></td>
                </tr>
            </tfoot>
        </table>
        
        <div class="cart-actions">
            <a href="product.php" class="button continue-btn">Continue Shopping</a>
            <?php if (isset($_SESSION['user_id'])): ?>
                <a href="checkout.php" class="button checkout-btn">Proceed to Checkout</a>
            <?php else: ?>
                <p class="warning">You must <a href="login.php">log in</a> to proceed to checkout.</p>
            <?php endif; ?>
        </div>
    <?php endif; ?>
</section>

<?php require_once '../templates/footer.php'; ?>