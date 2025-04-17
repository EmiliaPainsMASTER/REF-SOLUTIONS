<?php
session_start();
require_once '../src/Core/Database/DBconnect.php';
require_once '../src/Models/User.php';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    

    $email = $_POST['email'];
    $password = $_POST['password'];

    if (!empty($email) && !empty($password)) {
        try {
            $user = User::authentication($email, $password, $connection);
            if ($user) {
                
                $_SESSION['user_id'] = $user->getUserID();
                $_SESSION['user_email'] = $user->getEmail();
                
                $_SESSION['user_name'] = $user->getFName();

                header("Location: index.php");
                exit;
            }
        } catch (Exception $e) {
            echo "Error: " . $e->getMessage();
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="assets/css/main.css">
    <link rel="stylesheet" href="assets/css/layout.css">
</head>
<body>
<?php include '../templates/header.php' ?>
<section>
    <h2 class="title">Login</h2>
    <div class="container">
        <form method="post" action="Login.php">
            <label for="email">Email: </label>
            <input type="email" id="email" name="email" placeholder="Email" required>

            <label for="password">Password: </label>
            <input type="password" id="password" name="password" placeholder="Password" required>

            <input type="submit" value="Submit">
        </form>
        <p>Don't have an account? <a href="Register.php">Register</a></p>
    </div>
</section>
<?php include '../templates/footer.php' ?>
</body>
</html>