<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete Purchases</title>
    <link rel="stylesheet" href="../../css/main.css">
    <link rel="stylesheet" href="../../css/layout.css">
</head>
<?php
include "../../templates/header.php";
require "../../templates/loadAllFromSeasonalSaleTable.php";
?>
<body>
<section class="container">
    <h2>Delete Purchases</h2>
    <table>
        <thead>
        <tr>
            <th>Total</th>
            <th>Date</th>
            <th>Quantity</th>
            <th>Delete</th>
        </tr>
        </thead>
        <tbody>
        <?php if (!empty($purchases)) : ?>
            <?php foreach ($purchases as $purchase) : ?>
                <tr>
                    <td><?php echo $purchase->getPurchaseTotal(); ?></td>
                    <td><?php echo $purchase->getPurchaseDate(); ?></td>
                    <td><?php echo $purchase->getPurchaseQuantity(); ?></td>
                    <td><a href="delete-single.php?id=<?php echo $purchase->getPurchaseID(); ?>">Delete</a></td>
                </tr>
            <?php endforeach; ?>
        <?php endif; ?>
        </tbody>
    </table>
</section>
</body>
</html>