<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Purchases</title>
    <link rel="stylesheet" href="../../css/main.css">
    <link rel="stylesheet" href="../../css/layout.css">
</head>
<?php
require "../../DBtoPages/common.php";
require_once '../../DBtoPages/DBconnect.php';
require_once '../../DBtoObjects/PurchaseClassObject.php';

try {
    $purchases = PurchaseClassObject::loadAllFromDB($connection);
} catch (PDOException $error) {
    echo $error->getMessage();
}
?>
<body>
<section class="container">
    <h2>Update Purchases</h2>
    <table>
        <thead>
        <tr>
            <th>Total</th>
            <th>Date</th>
            <th>Quantity</th>
            <th>Edit</th>
        </tr>
        </thead>
        <tbody>
        <?php if (!empty($purchases)) : ?>
            <?php foreach ($purchases as $purchase) : ?>
                <tr>
                    <td><?php echo $purchase->getPurchaseTotal(); ?></td>
                    <td><?php echo $purchase->getPurchaseDate(); ?></td>
                    <td><?php echo $purchase->getPurchaseQuantity(); ?></td>
                    <td><a href="update-single.php?id=<?php echo $purchase->getPurchaseID(); ?>">Edit</a></td>
                </tr>
            <?php endforeach; ?>
        <?php else : ?>
            <tr><td colspan="4">No purchases found.</td></tr>
        <?php endif; ?>
        </tbody>
    </table>
</section>
</body>
</html>