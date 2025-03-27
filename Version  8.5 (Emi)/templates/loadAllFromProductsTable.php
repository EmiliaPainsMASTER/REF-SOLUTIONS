<?php
require __DIR__ . '/../DBtoPages/common.php';
require_once __DIR__ . '/../DBtoPages/DBconnect.php';
require_once __DIR__ . '/../DBtoObjects/Product.php';
try {
    // Fetch all products using the class method
    $products = Product::loadAllFromDB($connection);
} catch (PDOException $error) {
    echo $error->getMessage();
}
