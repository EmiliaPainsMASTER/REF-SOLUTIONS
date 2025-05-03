<?php
session_start();

require_once '../src/Models/User.php';
require_once '../src/Models/Product.php';

function test($name, $function) {
    echo "<h3>$name</h3>";
    try {
        $result = $function();
        echo " PASS: $result</p>";
    } catch (Exception $e) {
        echo " FAIL: ". ($e->getMessage())."</p>";
    }
}

//Password validation
test("Password must be at least 8 characters", function() {
    $user = new User();
    $user->setPassword("small");
    return "Password accepted";
});

//Product price validation
test("Product price must be positive", function() {
    $product = new Product();
    $product->setProductPrice(-10);
    return "positive price";
});

//User age validation
test("User must be at least 15 years old", function() {
    $user = new User();
    $user->setAge("2022-01-01"); 
    return "user accepted";
});

//Product name validation
test("Product name cannot be empty", function() {
    $product = new Product();
    $product->setProductName("");
    return "Done";
});

//Price limit validation
test("Product price cannot exceed €10,000", function() {
    $product = new Product();
    $product->setProductPrice(15000);
    return "Price under 10000";
});