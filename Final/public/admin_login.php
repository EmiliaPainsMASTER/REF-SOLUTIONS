<?php
session_start();
require_once '../src/Core/Database/DBconnect.php';
require_once '../src/Models/Admin.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    if (!empty($email) && !empty($password)) {
        try {
            $admin = Admin::authenticate($email, $password, $connection);
            if ($admin) {
                $_SESSION['admin_id'] = $admin->getAdminID();
                $_SESSION['admin_email'] = $admin->getAdminEmail();
                header("Location: crud.php"); // Redirect to admin dashboard
                exit;
            } else {
                $error = "Invalid credentials!";
            }
        } catch (Exception $e) {
            $error = "Error: " . $e->getMessage();
        }
    } else {
        $error = "Please fill all fields.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Login</title>
    <link rel="stylesheet" href="assets/css/main.css">
    <link rel="stylesheet" href="assets/css/layout.css">
</head>
<body>
<?php include '../templates/header.php'; ?>

<section>
    <h2 class="title">Admin Login</h2>
    <div class="container">
        <?php if (!empty($error)) echo "<p style='color:red;'>$error</p>"; ?>
        <form method="post" action="">
            <label for="email">Email: </label>
            <input type="email" name="email" id="email" placeholder="Admin Email" required>

            <label for="password">Password: </label>
            <input type="password" name="password" id="password" placeholder="Password" required>

            <input type="submit" value="Login">
        </form>
    </div>
</section>

<?php include '../templates/footer.php'; ?>
</body>
</html>
