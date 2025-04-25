<?php include '../../../templates/crudHead.php'?>
<title>Update Purchase</title>
</head>
<?php
include "../../templates/header.php";
require "../../templates/loadAllFromPurchaseTable.php";
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