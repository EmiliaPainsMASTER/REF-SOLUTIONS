<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="assets/css/main.css">
    <link rel="stylesheet" href="assets/css/layout.css">
</head>
<body>
    <?php include '../templates/header.php' ?>
    <section>
        <?php
        require "../src/Core/Utilities/common.php";
        require_once '../src/Core/Database/DBconnect.php';
        require_once '../src/Models/User.php';

        if (isset($_POST['submit'])) {
            try {
                $user = new User();
                $user->setFName($_POST['fname']);
                $user->setSName($_POST['sname']);
                $user->setEmail($_POST['email']);
                $user->setPassword($_POST['password']);
                $user->setAge($_POST['dob']);

                if ($user->insertDB($connection)) {
                    header("Location: index.php");
                    exit;
                } else {
                    echo "Failed to create a new user.";
                }
            } catch (Exception $e) {
                echo $e->getMessage();
            }
        }
        ?>
        <h2 class="title">Register</h2>

        <div class="container">
            <form method="post">
                <label for="email">Email: </label>
                <input type="email" id="email" name="email" placeholder="Email" required>

                <label for="fname">First Name: </label>
                <input type="text" id="fname" name="fname" placeholder="First Name" required>

                <label for="sname">Surname: </label>
                <input type="text" id="sname" name="sname" placeholder="Surname" required>

                <label for="dob">Date of Birth: </label>
                <input type="date" id="dob" name="dob" placeholder="Date of Birth" required>

                <label for="password">Password: </label>
                <input type="password" id="password" name="password" placeholder="Password" required>
                <input type="submit" name="submit" value="Submit">
            </form>
        </div>
    </section>
    <?php include 'templates/footer.php' ?>
</body>
</html>

