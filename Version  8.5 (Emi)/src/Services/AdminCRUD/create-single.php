<?php include '../../../templates/crudHead.php'?>
<title>Create a new Admin form</title>
</head>
<?php
require "../../Core/Utilities/common.php";
require_once '../../Core/Database/DBconnect.php';
require_once '../../Models/Admin.php';
if (isset($_POST['submit'])) {
    try {
        $admin = new Admin();
        $admin->setAdminName($_POST['AdminName']);
        $admin->setAdminEmail($_POST['AdminEmail']);
        $admin->setAdminPassword($_POST['AdminPassword']);
        if ($admin->insertDB($connection)){
            header("Location: ../../../public/index.php");
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
    <a href="../../../public/index.php">Back to Home</a>
</section>
<?php require "../../../templates/footer.php"; ?>
</body>
</html>