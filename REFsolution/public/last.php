<?php
session_start();
require_once '../src/Core/Database/DBconnect.php'; 
require_once '../src/Models/Purchase.php';

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Thank You</title>
    <link rel="stylesheet" href="assets/css/main.css">
    <link rel="stylesheet" href="assets/css/thanks.css">
    
</head>
<body>
    <div class="thanks_img">
        <?php if (isset($_SESSION['message'])) { ?>
            <div class="message">
                <?php echo htmlspecialchars($_SESSION['message']); ?>
                <?php unset($_SESSION['message']); ?>
            </div>
        <?php } ?>
        
        <img src="assets/img/thanks.jpg" alt="Thank you">
        <br>
        <a href="index.php" class="back_button">H O M E</a>
    </div>
    
    <?php include '../templates/footer.php'; ?>
</body>
</html>