<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update product form</title>
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
        $admin = AdminClassObject::loadFromDB($_POST['id'], $connection);
        $admin->setAdminName($_POST['AdminName']);
        $admin->setAdminEmail($_POST['AdminEmail']);
        $admin->setAdminPassword($_POST['AdminPassword']);
        if ($admin->updateDB($connection)){
            header("Location: update.php");
            exit;
        }
        else{
            echo "Something went wrong between lines 15-21!";
        }
    } catch (PDOException $error) {
        echo $error->getMessage();
    }
}

if (isset($_GET['id'])) {
    $admin = AdminClassObject::loadFromDB($_GET['id'], $connection);
} else {
    echo "Something went wrong between lines 32-35!";
    exit;
}

?>
<body>
<section>
    <h2 class="title">Edit an Admin</h2>

    <div class="container">
        <form method="post" action="update-single.php">
            <input type="hidden" name="id" value="<?php echo $admin->getAdminID(); ?>">

            <label for="AdminName">Admin Name</label>
            <input type="text" id="AdminName" name="AdminName" value="<?php echo $admin->getAdminName(); ?>">

            <label for="AdminEmail">Admin Email</label>
            <input type="email" id='AdminEmail' name="AdminEmail" value="<?php echo $admin->getAdminEmail(); ?>">

            <label for="AdminPassword">Admin Password</label>
            <input type="password" minlength="8" name="AdminPassword" id="AdminPassword" value="<?php echo $admin->getAdminPassword(); ?>">

            <input type="submit" name="submit" value="Submit">
        </form>
    </div>
    <a href="update.php">Back to Admin List</a>
</section>
<?php require "../../templates/footer.php"; ?>
</body>
</html>