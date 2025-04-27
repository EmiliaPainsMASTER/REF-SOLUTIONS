<?php

session_start();
require_once '../src/Models/Product.php';
require_once '../src/Core/Database/DBconnect.php';

if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        if (isset($_POST['action']) && isset($_POST['product_id'])) {
            $productId = (int)$_POST['product_id'];
            $action = $_POST['action'];
            
            if ($productId <= 0) {
                throw new Exception("Invalid product ID");
            }

            $product = Product::loadFromDB($productId, $connection);
            
            if (!$product) {
                throw new Exception("Product not found");
            }

            $productData = [
                'id' => $product->getProductID(),
                'name' => $product->getProductName(),
                'price' => $product->getProductPrice(),
                'desc' => $product->getProductDesc()
            ];

            switch ($action) {
                case 'add':
                    $quantity = 1;
                    if (isset($_POST['quantity'])) {
                        $quantity = (int)$_POST['quantity'];
                    }

                    // quantity validation
                    if ($quantity < 1) {
                        $_SESSION['error'] = "Please add at least 1 item";
                        header("Location: cart_view.php");
                        exit;
                    }

                    if ($quantity > 10) {
                        $_SESSION['error'] = "Maximum 10 items allowed per product";
                        header("Location: cart_view.php");
                        exit;
                    }
                    
                    
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
                        
                        if ($quantity < 1) {
                            $_SESSION['error'] = "You must add at least 1 item";
                            header("Location: cart_view.php");
                            exit;
                        }

                        if ($quantity > 10) {
                           $_SESSION['error'] = "You can only add 10 items max";
                            header("Location: cart_view.php");
                            exit;
                        }
                        
                        
                        if ($quantity > 0) {
                            $_SESSION['cart'][$productId]['quantity'] = $quantity;
                        }
                        else {
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

//total items calculation 
$cartCount = 0;
foreach ($_SESSION['cart'] as $item) {
    $cartCount += $item['quantity'];
}
$_SESSION['cart_count'] = $cartCount;



if (isset($_SERVER['HTTP_REFERER'])) {
    $go_back = $_SERVER['HTTP_REFERER'];
} else {
    $go_back = 'product.php';
}

header("Location: $go_back");
exit();