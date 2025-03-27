<?php include '../../../templates/crudHead.php'?>
<title>Update Product</title>
</head>



<?php
include "../../templates/header.php";
require "../../templates/loadAllFromProductsTable.php";
?>
<body>
<section class="container">
    <h2>Update Products</h2>
    <table>
        <thead>
        <tr>
            <th>Product Name</th>
            <th>Price</th>
            <th>Description</th>
            <th>Edit</th>
        </tr>
        </thead>
        <tbody>
        <?php if (!empty($products)) : ?>
        <?php foreach ($products as $product) : ?>
        <tr>
                <td><?php echo $product->getProductName(); ?></td>
                <td><?php echo $product->getProductPrice(); ?></td>
                <td><?php echo $product->getProductDesc(); ?></td>
                <td><a href="update-single.php?id=<?php echo $product->getProductID(); ?>">Edit</a></td>
            </tr>
        <?php endforeach; ?>
        <?php endif; ?>
        </tbody>
    </table>
</section>
<?php include '../../../templates/footer.php' ?>
</body>
</html>