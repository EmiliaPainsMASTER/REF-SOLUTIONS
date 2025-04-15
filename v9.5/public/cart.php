<?php
// cart.php
session_start();
require_once '../src/Models/Product.php';
require_once '../src/Core/Database/DBconnect.php';

// Initialize cart if it doesn't exist
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

// Handle actions
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        if (isset($_POST['action']) && isset($_POST['product_id'])) {
            $productId = (int)$_POST['product_id'];
            $action = $_POST['action'];
            
            // Validate product ID
            if ($productId <= 0) {
                throw new Exception("Invalid product ID");
            }

            // Load product from database
            $product = Product::loadFromDB($productId, $connection);
            
            if (!$product) {
                throw new Exception("Product not found");
            }

            // Convert product to array for session storage
            $productData = [
                'id' => $product->getProductID(),
                'name' => $product->getProductName(),
                'price' => $product->getProductPrice(),
             //   'image' => $product->getProductImage(),
                'desc' => $product->getProductDesc()
            ];

            switch ($action) {
                case 'add':
                    if (isset($_SESSION['cart'][$productId])) {
                        $_SESSION['cart'][$productId]['quantity'] += 1;
                    } else {
                        $_SESSION['cart'][$productId] = [
                            'product' => $productData,
                            'quantity' => 1
                        ];
                    }
                    break;
                    
                case 'remove':
                    if (isset($_SESSION['cart'][$productId])) {
                        unset($_SESSION['cart'][$productId]);
                    }
                    break;
                    
                case 'update':
                    if (isset($_POST['quantity']) && is_numeric($_POST['quantity'])) {
                        $quantity = (int)$_POST['quantity'];
                        if ($quantity > 0) {
                            $_SESSION['cart'][$productId]['quantity'] = $quantity;
                        } else {
                            unset($_SESSION['cart'][$productId]);
                        }
                    }
                    break;
                    
                default:
                    throw new Exception("Invalid action");
            }
        }
    } catch (Exception $e) {
        $_SESSION['error'] = $e->getMessage();
    }
}

// Calculate total items in cart for the counter
$cartCount = 0;
foreach ($_SESSION['cart'] as $item) {
    $cartCount += $item['quantity'];
}
$_SESSION['cart_count'] = $cartCount;

// Clear any incomplete class objects from previous sessions
foreach ($_SESSION['cart'] as $productId => $item) {
    if (is_object($item['product']) && get_class($item['product']) === '__PHP_Incomplete_Class') {
        $p = $item['product'];
        $_SESSION['cart'][$productId]['product'] = [
            'id' => $p->productID,
            'name' => $p->productName,
            'price' => $p->productPrice,
            'image' => $p->productImage,
            'desc' => $p->productDesc
        ];
    }
}

// Redirect back to previous page
$redirectUrl = $_SERVER['HTTP_REFERER'] ?? 'product.php';
header("Location: $redirectUrl");
exit();