<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update products</title>
    <link rel="stylesheet" href="../css/main.css">
    <link rel="stylesheet" href="../css/layout.css">
</head>

<?php
include "../templates/header.php"; // Include the header
require "../templates/loadAllFromDB.php"; // Load products from the DB
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
                    <td><?php echo $product->getProductName(); ?></td> <!-- Correct method name -->
                    <td><?php echo $product->getProductPrice(); ?></td> <!-- Correct method name -->
                    <td><?php echo $product->getProductDesc(); ?></td> <!-- Correct method name -->
                    <td><a href="update-single.php?id=<?php echo $product->getProductID(); ?>">Edit</a></td> <!-- Correct method name -->
                </tr>
            <?php endforeach; ?>
        <?php endif; ?>
        </tbody>
    </table>
</section>
<?php include '../templates/footer.php' ?>
</body>
</html>