<?php
require __DIR__ . '/../DBtoPages/common.php';
require_once __DIR__ .  '/../DBtoPages/DBconnect.php';
require_once  __DIR__ . '/../DBtoObjects/SeasonalSaleClassObject.php';

try {
    // Fetch all products using the class method
    $seasonalSales = SeasonalSaleClassObject::loadAllFromDB($connection);
} catch (PDOException $error) {
    echo $error->getMessage();
}
