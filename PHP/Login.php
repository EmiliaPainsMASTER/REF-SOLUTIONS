<?php
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="css/refSolution.css">
</head>
<body>
<div class="navbar">
    <a href="index.php">Home</a>
    <a href="about.php">About Us</a>
    <a href="product.php"> Buy Products</a>
    <a href="sell.php">Sell Products</a>
    <a href="history.php">History Items</a>
    <a href="Login.php">Login</a>
    <a href="Register.php">Register</a>
    <form class="searchbar" action="">
        <input type="text" placeholder="Search..">
    </form>
</div>

<h2 class="title">Login</h2>

<div class="container">
    <form action="">
        <label for="email">Email: </label>
        <input type="email" id="email" name="email" placeholder="Email" required>

        <label for="password">Password: </label>
        <input type="password" id="password" name="password" placeholder="Password" required>
        <input type="submit" value="Submit">
</div>
</body>
</html>

