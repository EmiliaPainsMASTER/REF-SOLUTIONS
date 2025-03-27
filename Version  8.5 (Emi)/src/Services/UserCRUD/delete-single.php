<?php include '../../../templates/crudHead.php'?>
<title>Delete User</title>
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