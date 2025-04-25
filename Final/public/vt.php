<?php
session_start();

require_once '../src/Models/User.php';
require_once '../src/Models/Product.php';

function runTest($name, $function) {
    echo "<h3>$name</h3>";
    try {
        $result = $function();
        echo " PASS: $result</p>";
    } catch (Exception $e) {
        echo " FAIL: ". ($e->getMessage())."</p>";
    }
    echo "</div>";
}

// Test 1: Password validation
runTest("Password must be at least 8 characters", function() {
    $user = new User();
    $user->setPassword("fail");
    return "Password accepted";
});

// Test 2: Product price validation
runTest("Product price must be positive", function() {
    $product = new Product();
    $product->setProductPrice(-10);
    return "positive price";
});

// Test 3: User age validation
runTest("User must be at least 15 years old", function() {
    $user = new User();
    $user->setAge("2022-01-01"); 
    return "user accepted";
});

// Test 4: Product name validation
runTest("Product name cannot be empty", function() {
    $product = new Product();
    $product->setProductName("");
    return "Done";
});

// Test 5: Price upper limit validation
runTest("Product price cannot exceed €10,000", function() {
    $product = new Product();
    $product->setProductPrice(15000);
    return "Price under 10000";
});