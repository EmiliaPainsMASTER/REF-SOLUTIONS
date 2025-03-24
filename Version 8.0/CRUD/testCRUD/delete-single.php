<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete Purchase</title>
    <link rel="stylesheet" href="../../css/main.css">
    <link rel="stylesheet" href="../../css/layout.css">
</head>
<?php
require "../../DBtoPages/common.php";
require_once '../../DBtoPages/DBconnect.php';
require_once '../../DBtoObjects/PurchaseClassObject.php';

if (isset($_GET["id"])) {
    try {
        $purchase = PurchaseClassObject::loadFromDB($_GET["id"], $connection);
        if ($purchase) {
            $purchase->deleteDB($connection);
        }
    } catch (PDOException $error) {
        echo $error->getMessage();
    }
}
header("Location: delete.php");
exit;
?>
</html>