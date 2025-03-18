<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete</title>
    <link rel="stylesheet" href="../../css/main.css">
    <link rel="stylesheet" href="../../css/layout.css">
</head>
<?php require "../../templates/header.php"; ?>
<?php
require "../../DBtoPages/common.php";
require_once '../../DBtoPages/DBconnect.php';
require_once '../../DBtoObjects/AdminClassObject.php';
$success = false;
if (isset($_GET["id"])) {
    try {
        $admin = AdminClassObject::loadFromDB($_GET["id"], $connection);
        if ($admin->deleteDB($connection)) {
            $success = true;
            echo "Success!";
        } else {
            echo "Something went wrong between lines 15-21";
            $success = false;
        }
    } catch (PDOException $error) {
        echo $error->getMessage();
        $success = false;
    }
}
    header("Location: delete.php");
?>
</html>