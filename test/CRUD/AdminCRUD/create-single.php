<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create a new Admin form</title>
    <link rel="stylesheet" href="../../css/main.css">
    <link rel="stylesheet" href="../../css/layout.css">
</head>
<?php require "../../templates/header.php"; ?>
<?php
require "../../DBtoPages/common.php";
require_once '../../DBtoPages/DBconnect.php';
require_once '../../DBtoObjects/AdminClassObject.php';
if (isset($_POST['submit'])) {
    try {
        $admin = new AdminClassObject();
        $admin->setAdminName($_POST['AdminName']);
        $admin->setAdminEmail($_POST['AdminEmail']);
        $admin->setAdminPassword($_POST['AdminPassword']);
        if ($admin->insertDB($connection)){
            header("Location: ../../index.php");
            exit;
        }
        else{
            echo "Something went wrong between lines 15-21";
        }
    }
    catch (Exception $e) {
        echo $e->getMessage();
    }
}
?>
<body>
<section>
    <h2 class="title">Create an Admin account</h2>

    <div class="container">
        <form method="post" action="create-single.php">
            <label for="AdminName">Admin Name</label>
            <input type="text" name="AdminName" id="AdminName" placeholder="Admin Name">

            <label for="AdminEmail">Admin Email</label>
            <input type="email" name="AdminEmail" id="AdminEmail" placeholder="Admin Email">

            <label for="AdminPassword">Admin Password</label>
            <input type="password" minlength="8" name="AdminPassword" id="AdminPassword" placeholder="Admin Password">

            <input type="submit" name="submit" value="Submit">
        </form>
    </div>
    <a href="../../index.php">Back to Home</a>
</section>
<?php require "../../templates/footer.php"; ?>
</body>
</html>