<?php
require_once '../src/Models/User.php';

// Test 1: Check if password must be 8+ characters
$user = new User();
try {
    $user->setPassword("abc"); // Too short
    echo "Test 1 FAIL: Short password was accepted\n";
} catch (Exception $e) {
    echo "Test 1 PASS: " . $e->getMessage() . "\n";
}

// Test 2: Check valid registration
try {
    $user->setEmail("user@.com");
    $user->setPassword("GoodPass123");
    $user->setAge("2000-01-01");
    echo "<br>Test 2 PASS: Valid user created\n";
} catch (Exception $e) {
    echo "<br>Test 2 FAIL: " . $e->getMessage() . "\n";
}
?>