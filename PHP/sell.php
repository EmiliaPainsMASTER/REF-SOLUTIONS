<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sell Form</title>
    <link rel="stylesheet" href="css/refSolution.css">
    <link rel="stylesheet" href="css/layout.css">
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

    <h2 class="title">Sell Form</h2>

    <div class="container">
        <form method="POST">
            <label for="fname">First & Last Name</label>
            <input type="text" id="fname" name="firstname" placeholder="Your Name">

            <label for="email">Email</label>
            <input type="email" id="email" name="email" placeholder="Email">

            <label for="item">Item Name</label>
            <input type="text" id="item" name="item" placeholder="Item Name">

            <label for="quantity">Quantity</label>
            <input type="number" id="quantity" name="quantity" placeholder="Quantity">

            <label for="address">Shipping Address</label>
            <input type="text" id="address" name="address" placeholder="Address line 1">

            <label for="city">City</label>
            <input type="text" id="city" name="city" placeholder="City">

            <label for="postal">Postal Code</label>
            <input type="text" id="postal" name="postal" placeholder="Postal / Zip Code">
            
            <label for="country">Country</label>
            <select id="country" name="country">
                <option value="Ireland">Ireland</option>
                <option value="UK">UK</option>
            </select>
            
            <input type="submit" value="Submit">
        </form>
    </div>
</body>
</html>
