<?php
session_start();
require_once '../src/Core/Database/DBconnect.php';
require_once '../src/Models/Admin.php';
require_once '../src/Models/Product.php';

if (!isset($_SESSION['admin_id'])) {
    header("Location: index.php");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Load existing or create new
    if (!empty($_POST['product_id'])) {
        $product = Product::loadFromDB($_POST['product_id'], $connection);
    } else {
        $product = new Product();
    }

    $product->setProductName($_POST['name']);
    $product->setProductPrice($_POST['price']);
    $product->setProductDesc($_POST['desc']);

    // Image
    if (!empty($_POST['image'])) {
        $imageName = trim($_POST['image']);
        $imagePath = "/img/" . $imageName;
        $product->setProductImage($imagePath);
    } else {
        echo "No image file.";
    }

    // Insert or Update
    if (!empty($_POST['product_id'])) {
        $product->updateDB($connection);
    } else {
        $product->insertDB($connection);
    }

    header("Location: crud.php");
    exit;
}

// Delete
if (isset($_GET['delete'])) {
    $product = Product::loadFromDB($_GET['delete'], $connection);
    if ($product) {
        $product->deleteDB($connection);
    }
    header("Location: crud.php");
    exit;
}

//Edit
$editProduct = null;
if (isset($_GET['edit'])) {
    $editProduct = Product::loadFromDB($_GET['edit'], $connection);
}

$products = Product::loadAllFromDB($connection);
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Admin - Product Management</title>
    <link rel="stylesheet" href="assets/css/main.css">
    <link rel="stylesheet" href="assets/css/layout.css">
</head>
<body>
<?php include '../templates/header.php'; ?>
<section>
    <h2 class="title">Manage Products</h2>
    <div class="container">

        <form method="post" action="crud.php" enctype="multipart/form-data">
            <label for="name">Product Name:</label>
            <input type="text" name="name" required value="<?= $editProduct ? $editProduct->getProductName() : '' ?>">

            <label for="price">Price:</label>
            <input type="number" name="price" step="0.01" required value="<?= $editProduct ? $editProduct->getProductPrice() : '' ?>">

            <label for="desc">Description:</label>
            <textarea name="desc" required><?= $editProduct ? $editProduct->getProductDesc() : '' ?></textarea>

            <label for="image">Image File Name:</label>
            <input type="text" name="image" placeholder="image.jpg" required value="<?= $editProduct ? basename($editProduct->getProductImage()) : '' ?>">

            <?php if ($editProduct): ?>
                <input type="hidden" name="product_id" value="<?= $editProduct->getProductID(); ?>">
                <input type="submit" value="Update Product">
            <?php else: ?>
                <input type="submit" value="Add Product">
            <?php endif; ?>
        </form>

        <h3>All Products</h3>
        <table border="1" cellpadding="10" cellspacing="0">
            <tr>
                <th>ID</th><th>Name</th><th>Price</th><th>Description</th><th>Actions</th>
            </tr>
            <?php foreach ($products as $product): ?>
                <tr>
                    <td><?= $product->getProductID(); ?></td>
                    <td><?= $product->getProductName(); ?></td>
                    <td>€<?= $product->getProductPrice(); ?></td>
                    <td><?= $product->getProductDesc(); ?></td>
                    
                    <td>
                        <a href="?edit=<?= $product->getProductID(); ?>">Edit</a> |
                        <a href="?delete=<?= $product->getProductID(); ?>" onclick="return confirm('Delete this product?')">Delete</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </table>
    </div>
</section>
<?php include '../templates/footer.php'; ?>
</body>
</html>
