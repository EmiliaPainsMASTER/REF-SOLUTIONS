<?php include "../../../templates/crudHead.php"; ?>
<title>Update Admin form</title>
</head>

<?php require "../../../templates/header.php";
require "../../Core/Utilities/common.php";
require_once '../../Core/Database/DBconnect.php';
require_once '../../Models/Admin.php';
if (isset($_POST['submit'])) {
    try {
        $admin = Admin::loadFromDB($_POST['id'], $connection);
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
    $admin = Admin::loadFromDB($_GET['id'], $connection);
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
<?php require "../../../templates/footer.php"; ?>
</body>
</html>