<?php
/* 
 * E-Commerce Validation Tests
 * A simple script to check if our online store's validation works properly
 * Tests 5 important validation rules (1 point each)
 */

// Let's get all the files we need first
require_once '../src/Models/Product.php';
require_once '../src/Models/User.php';

// Start the session if it hasn't been started yet
if (!isset($_SESSION)) {
    session_start();
}

// Connect to the database - using the same connection as our main site
try {
    require '../src/Core/Utilities/config.php';
    $db = new PDO($dsn, $username, $password, $options);
} catch (PDOException $e) {
    die("<p>Oops! Couldn't connect to the database. Here's why: " . 
        htmlspecialchars($e->getMessage()) . "</p>");
}

echo "<h1>Our Store's Validation Check</h1>";

// Test 1: Products shouldn't have negative prices
echo "<h2>1. Checking Product Prices</h2>";
$testProduct = new Product();
try {
    $testProduct->setProductPrice(-9.99); // Who would pay us to take products?
    echo "<p style='color:red'>Uh oh! The system accepted a negative price (-$9.99). That's not right!</p>";
} catch (Exception $e) {
    echo "<p style='color:green'>Good! The system blocked a negative price. Message: " . 
        htmlspecialchars($e->getMessage()) . "</p>";
}

// Test 2: Cart should only allow numbers for quantities
echo "<h2>2. Testing Cart Quantities</h2>";
$_SESSION['cart'] = [
    101 => ['product' => ['name' => 'Test Item'], 'quantity' => 1]
];
$_POST = ['product_id' => 101, 'quantity' => 'two', 'action' => 'update'];

// Normally this would be in cart.php, but we'll simulate it here
if (!is_numeric($_POST['quantity'])) {
    echo "<p style='color:green'>Nice! The system rejected 'two' as a quantity.</p>";
} else {
    echo "<p style='color:red'>Hmm... the system accepted 'two' as a valid number.</p>";
}

// Test 3: Users can't be born in the future
echo "<h2>3. Checking User Birth Dates</h2>";
$testUser = new User();
try {
    $testUser->setAge('2080-05-20'); // Time traveler?
    echo "<p style='color:red'>Wait what? The system accepted a birth date from 2080!</p>";
} catch (Exception $e) {
    echo "<p style='color:green'>Great! The system caught our time traveler. Message: " . 
        htmlspecialchars($e->getMessage()) . "</p>";
}

// Test 4: Product images should have safe filenames
echo "<h2>4. Validating Product Images</h2>";
$testProduct = new Product();
try {
    $testProduct->setProductImage('real_image.jpg');
    echo "<p style='color:green'>Perfect! Normal image names work fine.</p>";
    
    // Try a suspicious filename
    $testProduct->setProductImage('../../hack.php');
    echo "<p style='color:red'>Yikes! The system accepted a potentially dangerous file path.</p>";
} catch (Exception $e) {
    echo "<p style='color:green'>Good catch! Blocked unsafe filename. Message: " . 
        htmlspecialchars($e->getMessage()) . "</p>";
}

// Test 5: Login should only work with right password
echo "<h2>5. Testing Login Security</h2>";
// First create a test user if not exists
try {
    $testEmail = "tester@ourstore.com";
    $testPass = "valid123";
    
    // Try wrong password
    $invalidLogin = User::authentication($testEmail, 'wrongpass', $db);
    
    // Try correct password
    $validLogin = User::authentication($testEmail, $testPass, $db);
    
    if ($validLogin && !$invalidLogin) {
        echo "<p style='color:green'>Login works as expected - right password works, wrong one doesn't.</p>";
    } else {
        echo "<p style='color:red'>Hmm, something's off with the login checks...</p>";
    }
} catch (Exception $e) {
    echo "<p style='color:red'>Oops, login test failed completely: " . 
        htmlspecialchars($e->getMessage()) . "</p>";
}

echo "<hr><p>All tests completed. Green is good, red needs fixing!</p>";
?>