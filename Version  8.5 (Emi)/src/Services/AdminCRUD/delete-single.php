<?php include "../../../templates/crudHead.php"; ?>
<title>Delete</title>
</head>
<?php require "../../templates/header.php"; ?>
<?php
require "../../Core/Utilities/common.php";
require_once '../../Core/Database/DBconnect.php';
require_once '../../Models/Admin.php';
$success = false;
if (isset($_GET["id"])) {
    try {
        $admin = Admin::loadFromDB($_GET["id"], $connection);
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
    exit;
?>
</html>