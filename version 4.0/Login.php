<?php
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="css/refSolution.css">
    <link rel="stylesheet" href="css/layout.css">
</head>
<body>
    <?php include 'header.php'?>
    <section>
        <h2 class="title">Login</h2>

        <div class="container">
            <form method="get">
                <label for="email">Email: </label>
                <input type="email" id="email" name="email" placeholder="Email" required>

                <label for="password">Password: </label>
                <input type="password" id="password" name="password" placeholder="Password" required>
                <input type="submit" value="Submit">
            </form>
        </div>
    </section>
    <?php include 'footer.php'?>
</body>
</html>

