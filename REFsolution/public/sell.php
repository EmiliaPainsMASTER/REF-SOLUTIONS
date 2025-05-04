<?php
session_start();
require_once '../src/Core/Database/DBconnect.php';

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        $sellerName = $_POST['firstname'];
        $email = $_POST['email'];
        $itemName = $_POST['item'];
        $quantity = (int)$_POST['quantity'];
        $eircode = $_POST['eircode'];
        $country = $_POST['country'];

        // validation
        if (empty($sellerName) || empty($email) || empty($itemName) || empty($eircode) || $quantity <= 0) {
            throw new Exception("Please fill all required fields");
        }

        $stmt = $connection->prepare("
            INSERT INTO sell 
            (seller_name, email, item_name, quantity, eircode, country) 
            VALUES (?, ?, ?, ?, ?, ?)
        ");
        
        $stmt->execute([
            $sellerName, 
            $email, 
            $itemName, 
            $quantity, 
            $eircode, 
            $country
        ]);

        $_SESSION['message'] = "Your item has been uploaded. One of our member will contact you.";
        header("Location: sell.php");
        exit();

    } catch (Exception $e) {
        $_SESSION['error'] = "Error: " . $e->getMessage();
        header("Location: sell.php");
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sell Form</title>
    <link rel="stylesheet" href="../public/assets/css/main.css">
    <link rel="stylesheet" href="../public/assets/css/layout.css">
</head>
<body>
    <?php include '../templates/header.php'; ?>
    <section>
        <h2 class="title">Sell Form</h2>
        
        <?php if (isset($_SESSION['message'])): ?>
            <div class="success-message"><?= $_SESSION['message'] ?></div>
            <?php unset($_SESSION['message']); ?>
        <?php endif; ?>
        
        <?php if (isset($_SESSION['error'])): ?>
            <div class="error-message"><?= $_SESSION['error'] ?></div>
            <?php unset($_SESSION['error']); ?>
        <?php endif; ?>

        <div class="container">
            <form method="post">
                <label for="fname">Full Name</label>
                <input type="text" id="fname" name="firstname" placeholder="Your Name" required>

                <label for="email">Email</label>
                <input type="email" id="email" name="email" placeholder="Email" required>

                <label for="item">Item Name</label>
                <input type="text" id="item" name="item" placeholder="Item Name" required>

                <label for="quantity">Quantity</label>
                <input type="number" id="quantity" name="quantity" placeholder="Quantity" min="1" required>

                <label for="eircode">Eircode</label>
                <input type="text" id="eircode" name="eircode" placeholder="Eircode">

                <label for="country">Country</label>
                <select id="country" name="country">
                    <option value="Ireland">Ireland</option>
                    <option value="UK">UK</option>
                </select>

                <input type="submit" value="Submit">
            </form>
        </div>
    </section>
    <?php include '../templates/footer.php' ?>
</body>
</html>