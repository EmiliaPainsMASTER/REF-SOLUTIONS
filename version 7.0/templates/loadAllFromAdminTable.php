<?php
require __DIR__ . '/../DBtoPages/common.php';
require_once __DIR__ .  '/../DBtoPages/DBconnect.php';
require_once  __DIR__ . '/../DBtoObjects/AdminClassObject.php';

try {
    $admin = AdminClassObject::loadAllFromDB($connection);
} catch (PDOException $error) {
    echo $error->getMessage();
}
