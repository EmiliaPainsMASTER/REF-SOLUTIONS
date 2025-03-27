<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update User</title>
    <link rel="stylesheet" href="../../../public/assets/css/main.css">
    <link rel="stylesheet" href="../../../public/assets/css/layout.css">
</head>
<?php require "../../templates/header.php"; ?>
<?php
require "../../DBtoPages/common.php";
require_once '../../DBtoPages/DBconnect.php';
require_once '../../DBtoObjects/User.php';

if (isset($_POST['submit'])) {
    try {
        $user = User::loadFromDB($_POST['id'], $connection);
        $user->setFName($_POST['firstName']);
        $user->setSName($_POST['lastName']);
        $user->setEmail($_POST['email']);
        $user->setPassword($_POST['password']);
        $user->setAge($_POST['age']);
        if ($user->updateDB($connection)) {
            header("Location: update.php");
            exit;
        } else {
            echo "Failed to update the user.";
        }
    } catch (Exception $e) {
        echo $e->getMessage();
    }
}

if (isset($_GET['id'])) {
    $user = User::loadFromDB($_GET['id'], $connection);
} else {
    echo "Something went wrong between lines 32-35!";
    exit;
}
?>
<body>
<section>
    <h2>Update User</h2>
    <div class="container">
        <form method="post" action="update-single.php">
            <input type="hidden" name="id" value="<?php echo $user->getUserID(); ?>">

            <label for="firstName">First Name</label>
            <input type="text" id="firstName" name="firstName" value="<?php echo $user->getFName(); ?>" required>

            <label for="lastName">Last Name</label>
            <input type="text" id="lastName" name="lastName" value="<?php echo $user->getSName(); ?>" required>

            <label for="email">Email</label>
            <input type="email" id="email" name="email" value="<?php echo $user->getEmail(); ?>" required>

            <label for="password">Password</label>
            <input type="password" id="password" name="password" value="<?php echo $user->getPassword(); ?>" required>

            <label for="age">Age</label>
            <input type="date" id="age" name="age" value="<?php echo $user->getAge(); ?>">

            <input type="submit" name="submit" value="Submit">
        </form>
    </div>
    <a href="update.php">Back to Users</a>
</section>
<?php require "../../templates/footer.php"; ?>
</body>
</html>