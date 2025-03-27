<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete User</title>
    <link rel="stylesheet" href="../../../public/assets/css/main.css">
    <link rel="stylesheet" href="../../../public/assets/css/layout.css">
</head>
<?php require "../../templates/header.php"; ?>
<?php
require "../../DBtoPages/common.php";
require_once '../../DBtoPages/DBconnect.php';
require_once '../../DBtoObjects/User.php';

if (isset($_GET["id"])) {
    try {
        $user = User::loadFromDB($_GET["id"], $connection);
        if ($user->deleteDB($connection)) {
            header("Location: delete.php");
            exit;
        } else {
            echo "Failed to delete the user.";
        }
    } catch (Exception $e) {
        echo $e->getMessage();
    }
} else {
    echo "No user ID was provided.";
    exit;
}
?>
</html>