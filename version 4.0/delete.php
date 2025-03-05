<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="css/refSolution.css">
    <link rel="stylesheet" href="css/layout.css">
</head>

    <?php

try {
    require "common.php";
    require_once 'src/DBconnect.php';

    $sql = "SELECT * FROM products";
    $statement = $connection->prepare($sql);
    $statement->execute();
    $result = $statement->fetchAll();
} catch (PDOException $error) {
    echo $sql . "<br>" . $error->getMessage();
}
?>

<?php require "header.php"; ?>

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
        <?php foreach ($result as $row) : ?>
            <tr>
                <td><?php echo escape($row["ProductName"]); ?></td>
                <td><?php echo escape($row["Price"]); ?></td>
                <td><?php echo escape($row["ProductDesc"]); ?></td>
                <td>
                    <a href="delete_product.php?id=<?php echo escape($row["ProductID"]); ?>">Delete</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<a href="index.php">Back to Home</a>

<?php require "footer.php"; ?>
</html>