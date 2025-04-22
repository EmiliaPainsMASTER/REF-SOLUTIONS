<?php
require_once '../src/Models/Product.php';

// Test 1: Price must be positive
$product = new Product();
try {
    $product->setProductPrice(-10);
    echo "Test 1 FAIL: Negative price accepted\n";
} catch (Exception $e) {
    echo "Test 1 PASS: " . $e->getMessage() . "\n";
}

// Test 2: Name can't be empty
try {
    $product->setProductName("Laptop");
    echo "<br>Test 2 PASS: Valid product name\n";
} catch (Exception $e) {
    echo "<br>Test 2 FAIL: " . $e->getMessage() . "\n";
}
?>