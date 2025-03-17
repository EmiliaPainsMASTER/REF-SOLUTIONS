<?php
require "../DBtoPages/common.php"; // Utilities for escaping
require_once '../DBtoPages/DBconnect.php'; // Database connection
require_once '../DBtoObjects/ProductsClassObject.php'; // Load the ProductsClassObject

try {
    // Fetch all products using the class method
    $products = ProductsClassObject::loadAllFromDB($connection);
} catch (PDOException $error) {
    echo $error->getMessage();
}
