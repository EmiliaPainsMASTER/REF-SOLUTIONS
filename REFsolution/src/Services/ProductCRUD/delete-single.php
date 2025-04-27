<?php include '../../../templates/crudHead.php'?>
<title>Delete Product</title>
</head>
<?php require "../../templates/header.php"; ?>
<?php
require "../../DBtoPages/common.php";
require_once '../../DBtoPages/DBconnect.php';
require_once '../../DBtoObjects/Product.php';
$success = false;
if (isset($_GET["id"])) {
    try {
        $product = Product::loadFromDB($_GET["id"], $connection);
        if ($product->deleteDB($connection)) {
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