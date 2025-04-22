<?php
require "../src/Core/Utilities/common.php";
require_once '../src/Core/Database/DBconnect.php';
require_once '../src/Models/Product.php';
try {
    // Fetch all products using the class method
    $products = Product::loadAllFromDB($connection);
} catch (PDOException $error) {
    echo $error->getMessage();
}
