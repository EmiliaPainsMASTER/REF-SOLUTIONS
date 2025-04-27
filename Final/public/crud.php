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
    try {
        if (isset($_POST['delete_id'])) {
            $product = Product::loadFromDB($_POST['delete_id'], $connection);
            if ($product) {
                $product->deleteDB($connection);
            }
            header("Location: crud.php");
            exit;
        }

        if (!empty($_POST['product_id'])) {
            $product = Product::loadFromDB($_POST['product_id'], $connection);
        } else {
            $product = new Product();
        }

        $product->setProductName($_POST['name']);
        $product->setProductPrice($_POST['price']);
        $product->setProductDesc($_POST['desc']);

        if (!empty($_POST['image'])) {
            $imagePath = "/img/" . trim($_POST['image']);
            $product->setProductImage($imagePath);
        } else {
            throw new Exception("Image file name is required.");
        }

        if (!empty($_POST['product_id'])) {
            $product->updateDB($connection);
        } else {
            $product->insertDB($connection);
        }

        header("Location: crud.php");
        exit;

    } catch (Exception $e) {
        $_SESSION['error'] = $e->getMessage();
        header("Location: crud.php");
        exit;
    }
}

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
    <h2 class="admin-title">Admin Manage Products</h2>

    <?php if (isset($_SESSION['error'])): ?>
        <div class="error-message">
            <?= htmlspecialchars($_SESSION['error']); ?>
        </div>
        <?php unset($_SESSION['error']); ?>
    <?php endif; ?>

    <div class="container">
        <form method="post" action="crud.php" enctype="multipart/form-data" class="product-form">
            <label for="name">Product Name:</label>
            <input type="text" name="name" required value="<?= $editProduct ? htmlspecialchars($editProduct->getProductName()) : '' ?>">

            <label for="price">Price:</label>
            <input type="number" name="price" step="0.01" required value="<?= $editProduct ? htmlspecialchars($editProduct->getProductPrice()) : '' ?>">

            <label for="desc">Description:</label>
            <textarea name="desc" required><?= $editProduct ? htmlspecialchars($editProduct->getProductDesc()) : '' ?></textarea>

            <label for="image">Image File Name:</label>
            <input type="text" name="image" placeholder="image.jpg" required value="<?= $editProduct ? htmlspecialchars(basename($editProduct->getProductImage())) : '' ?>">

            <?php if ($editProduct): ?>
                <input type="hidden" name="product_id" value="<?= $editProduct->getProductID(); ?>">
                <input type="submit" value="Update Product">
            <?php else: ?>
                <input type="submit" value="Add Product">
            <?php endif; ?>
        </form>

        <h3>All Products</h3>
        <table class="product-table">
            <tr>
                <th>ID</th><th>Name</th><th>Price</th><th>Description</th><th>Actions</th>
            </tr>
            <?php foreach ($products as $product): ?>
                <tr>
                    <td><?= $product->getProductID(); ?></td>
                    <td><?= htmlspecialchars($product->getProductName()); ?></td>
                    <td>€<?= htmlspecialchars($product->getProductPrice()); ?></td>
                    <td><?= htmlspecialchars($product->getProductDesc()); ?></td>
                    <td>
                        <a href="?edit=<?= $product->getProductID(); ?>">Edit</a>
                        <details>
                            <summary class="delete-summary">Delete</summary>
                            <form method="post" action="crud.php" class="delete-form">
                                <input type="hidden" name="delete_id" value="<?= $product->getProductID(); ?>">
                                <button type="submit" class="confirm-delete-button">Confirm Delete</button>
                            </form>
                        </details>
                    </td>
                </tr>
            <?php endforeach; ?>
        </table>
    </div>
</section>
<?php include '../templates/footer.php'; ?>
</body>
</html>