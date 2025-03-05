<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="css/refSolution.css">
    <link rel="stylesheet" href="css/layout.css">
</head>
    
    <?php

require "common.php";

if (isset($_POST['submit'])) {
    try {
        require_once 'src/DBconnect.php';

        $product = [
            "id" => escape($_POST['ProductID']),
            "productname" => escape($_POST['ProductName']),
            "price" => escape($_POST['Price']),
            "description" => escape($_POST['ProductDesc'])
        ];

        $sql = "UPDATE products
                SET ProductName = :productname,
                    Price = :price,
                    ProductDesc = :description
                WHERE ProductID = :id";


        $statement = $connection->prepare($sql);
        $statement->execute($product);
        
        header("Location: update.php");
        exit();

    } catch (PDOException $error) {
        echo $sql . "<br>" . $error->getMessage();
    }
}

if (isset($_GET['id'])) {
    try {
        require_once 'src/DBconnect.php';
        $id = $_GET['id'];

        $sql = "SELECT * FROM products WHERE ProductID = :id";
        $statement = $connection->prepare($sql);
        $statement->bindValue(':id', $id);
        $statement->execute();
        $product = $statement->fetch(PDO::FETCH_ASSOC);
    } catch (PDOException $error) {
        echo $sql . "<br>" . $error->getMessage();
    }
} else {
    echo "Something went wrong!";
    exit;
}

?>
 
    <?php if (isset($_POST['submit']) && $statement) : ?>
    <p><?php echo escape($_POST['productname']); ?> successfully updated.</p>
<?php endif; ?>

<h2>Edit a Product</h2>

<form method="post">
    <!-- Dynamically create input fields using foreach -->
    <?php foreach ($product as $key => $value) : ?>
        <?php if ($key !== 'Image') : ?>
            <br><label for="<?php echo $key; ?>"><?php echo ucfirst($key); ?></label>
            <br><input type="text" name="<?php echo $key; ?>" id="<?php echo $key; ?>" value="<?php echo escape($value); ?>" <?php echo ($key === 'ProductID' ? 'readonly' : null); ?>>
        <?php endif; ?>
    <?php endforeach; ?>

    <input type="submit" name="submit" value="Submit">
</form>

<a href="update.php">Back to Products List</a>

<?php require "footer.php"; ?>
</html>