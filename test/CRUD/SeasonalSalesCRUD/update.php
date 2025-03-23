<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Seasonal Sales</title>
    <link rel="stylesheet" href="../../css/main.css">
    <link rel="stylesheet" href="../../css/layout.css">
</head>
<?php
require "../../DBtoPages/common.php";
require_once '../../DBtoPages/DBconnect.php';
require_once '../../DBtoObjects/SeasonalSaleClassObject.php';

try {
    $seasonalSales = SeasonalSaleClassObject::loadAllFromDB($connection);
} catch (Exception $e) {
    echo $e->getMessage();
}
?>
<body>
<section class="container">
    <h2>Update Seasonal Sales</h2>
    <table>
        <thead>
        <tr>
            <th>Easter Products</th>
            <th>St Patricks Day Products</th>
            <th>Edit</th>
        </tr>
        </thead>
        <tbody>
        <?php if (!empty($seasonalSales)) : ?>
            <?php foreach ($seasonalSales as $seasonalSale) : ?>
                <tr>
                    <td><?php echo $seasonalSale->getSeasonalSaleEasterProducts(); ?></td>
                    <td><?php echo $seasonalSale->getSeasonalSaleStPatricksDayProducts(); ?></td>
                    <td><a href="update-single.php?id=<?php echo $seasonalSale->getSeasonalSaleID(); ?>">Edit</a></td>
                </tr>
            <?php endforeach; ?>
        <?php endif; ?>
        </tbody>
    </table>
</section>
<?php require "../../templates/footer.php"; ?>
</body>
</html>