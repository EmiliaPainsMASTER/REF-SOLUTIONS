<?php
require __DIR__ . '/../DBtoPages/common.php';
require_once __DIR__ . '/../DBtoPages/DBconnect.php';
require_once __DIR__ . '/../DBtoObjects/Admin.php';

try {
    $admins = Admin::loadAllFromDB($connection);
} catch (PDOException $error) {
    echo $error->getMessage();
}
