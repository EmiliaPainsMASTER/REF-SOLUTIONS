<?php include BASE_PATH . 'templates/crudHead.php'?>
<title>Create User</title>
</head>
<?php require BASE_PATH . "templates/header.php"; ?>
<?php
require  BASE_PATH . "src/Core/Utilities/common.php";
require_once BASE_PATH . 'src/Core/Database/DBconnect.php';
require_once BASE_PATH . 'src/Models/User.php';

if (isset($_POST['submit'])) {
    try {
        $user = new User();
        $user->setFName($_POST['firstName']);
        $user->setSName($_POST['lastName']);
        $user->setEmail($_POST['email']);
        $user->setPassword($_POST['password']);
        $user->setAge($_POST['age']);
        if ($user->insertDB($connection)) {
            header("Location: " . BASE_PATH . 'public/index.php');
            exit;
        } else {
            echo "Failed to create a new user.";
        }
    } catch (Exception $e) {
        echo $e->getMessage();
    }
}
?>
<body>
<section>
    <h2>Create User</h2>
    <div class="container">
        <form method="post" action="create-single.php">
            <label for="firstName">First Name</label>
            <input type="text" name="firstName" id="firstName" placeholder="First Name" required>

            <label for="lastName">Last Name</label>
            <input type="text" name="lastName" id="lastName" placeholder="Last Name" required>

            <label for="email">Email</label>
            <input type="email" name="email" id="email" placeholder="Email" required>

            <label for="password">Password</label>
            <input type="password" name="password" id="password" placeholder="Password" required>

            <label for="age">Age</label>
            <input type="date" name="age" id="age">

            <input type="submit" name="submit" value="Submit">
        </form>
    </div>
    <a href="../../../public/index.php">Back to Users</a>
</section>
<?php require BASE_PATH .  "templates/footer.php"; ?>
</body>
</html>