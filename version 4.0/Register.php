<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="css/css.css">
</head>
<body>
<div class="topnav">
    <a href="index.php">Home</a>
    <a href="About.php">About Us</a>
    <a href="product.php"> Buy Products</a>
    <a href="sell.html">Sell Products</a>
    <a href="history.html">History Items</a>
    <a href="Login.php">Login</a>
    <a href="Register.php">Register</a>
    <form class="searchbar" action="">
        <input type="text" placeholder="Search..">
    </form>
</div>
    <?php
if (isset($_POST['submit'])) {
    require "config.php"; 

    try {
        $connection = new PDO($dsn, $username, $password, $options);
        
        $new_user = array(
            "fname" => $_POST['fname'],
            "sname" => $_POST['sname'],
            "email" => $_POST['email'],
            "age" => $_POST['age'], 
            "password" => ($_POST['password']) 
        );

        $sql = sprintf("INSERT INTO %s (%s) values (%s)", "user",
        implode(", ", array_keys($new_user)),
        ":" . implode(", :", array_keys($new_user)));
        
        $statement = $connection->prepare($sql);
        $statement->execute($new_user);

        echo "Registration successful!";
    } catch (PDOException $error) {
        echo "Error: " . $error->getMessage();
    }
}
?>

<h2 class="title">Register</h2>

<div class="container">
    <form method="POST">
        <label for="email">Email: </label>
        <input type="email" id="email" name="email" placeholder="Email" required>

        <label for="fname">First Name: </label>
        <input type="text" id="fname" name="fname" placeholder="First Name" required>

        <label for="sname">Surname: </label>
        <input type="text" id="sname" name="sname" placeholder="Surname" required>

        <label for="age">Age: </label>
        <input type="date" id="age" name="age" placeholder="Age" required>

        <label for="password">First & Last Name</label>
        <input type="password" id="password" name="password" placeholder="Password" required>
        <input type="submit" name="submit" value="Submit">
    </form>
</div>
    
      
    
</body>
</html>

