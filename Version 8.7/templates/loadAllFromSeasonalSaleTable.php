<?php
require BASE_PATH. 'src/Core/Utilities/common.php';
require_once BASE_PATH . 'src/Core/Database/DBconnect.php';
require_once BASE_PATH . 'src/Models/SeasonalSale.php';


try {
    // Fetch all products using the class method
    $seasonalSales = SeasonalSale::loadAllFromDB($connection);
} catch (PDOException $error) {
    echo $error->getMessage();
}
