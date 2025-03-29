<?php include '../../../templates/crudHead.php'?>
<title>Delete Purchase</title>
</head>
<?php
require "../../DBtoPages/common.php";
require_once '../../DBtoPages/DBconnect.php';
require_once '../../DBtoObjects/Purchase.php';

if (isset($_GET["id"])) {
    try {
        $purchase = Purchase::loadFromDB($_GET["id"], $connection);
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