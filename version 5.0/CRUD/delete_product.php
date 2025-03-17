<?php

require "common.php";

$success = ""; 
if (isset($_GET["id"])) {
    try {
        require_once 'src/DBconnect.php';
        $id = $_GET["id"];
        
        $sql = "DELETE FROM products WHERE ProductID = :id";
        $statement = $connection->prepare($sql);
        $statement->bindValue(':id', $id);
        $statement->execute();

        $success = "Product with ID " . $id . " successfully deleted.";
    } catch (PDOException $error) {
        echo $sql . "<br>" . $error->getMessage();
    }
}

try {
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

<h2>Delete Products</h2>

<?php if ($success) echo "<p>$success</p>"; ?>

<table>
    <thead>
        <tr>
            <th>#</th>
            <th>Product Name</th>
            <th>Price</th>
            <th>Description</th>
            <th>Image</th>
            <th>Delete</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($result as $row) : ?>
            <tr>
                <td><?php echo escape($row["ProductID"]); ?></td>
                <td><?php echo escape($row["ProductName"]); ?></td>
                <td><?php echo escape($row["Price"]); ?></td>
                <td><?php echo escape($row["ProductDesc"]); ?></td>
                <td><img src="<?php echo escape($row["Image"]); ?>" alt="Product Image" width="50"></td>
                <td><a href="delete.php?id=<?php echo escape($row[">Delete</a></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<a href="../index.php">Back to home</a>

<?php require "footer.php"; ?>
