<?php include '../../../templates/crudHead.php'?>
<title>Delete Seasonal Sale</title>
</head>

<?php
include "../../templates/header.php";
require "../../templates/loadAllFromSeasonalSaleTable.php";
?>
<body>
<section class="container">
    <h2>Delete Seasonal Sales</h2>
    <table>
        <thead>
        <tr>
            <th>Easter Products</th>
            <th>St. Patrick's Day Products</th>
            <th>Delete</th>
        </tr>
        </thead>
        <tbody>
        <?php if (!empty($seasonalSales)) : ?>
            <?php foreach ($seasonalSales as $seasonalSale) : ?>
                <tr>
                    <td><?php echo $seasonalSale->getSeasonalSaleEasterProducts(); ?></td>
                    <td><?php echo $seasonalSale->getSeasonalSaleStPatricksDayProducts(); ?></td>
                    <td><a href="delete-single.php?id=<?php echo $seasonalSale->getSeasonalSaleID(); ?>">Delete</a></td>
                </tr>
            <?php endforeach; ?>
        <?php endif; ?>
        </tbody>
    </table>
</section>
<?php include '../../../templates/footer.php' ?>
</body>
</html>