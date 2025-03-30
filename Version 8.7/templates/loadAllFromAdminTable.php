<?php
require BASE_PATH. 'src/Core/Utilities/common.php';
require_once BASE_PATH . 'src/Core/Database/DBconnect.php';
require_once BASE_PATH . 'src/Models/Admin.php';

try {
    $admins = Admin::loadAllFromDB($connection);
} catch (PDOException $error) {
    echo $error->getMessage();
}
