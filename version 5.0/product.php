<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="css/refSolution.css">
    <link rel="stylesheet" href="css/layout.css">
    <title>Products</title>
</head>
<body>
    <?php include 'header.php'; ?>
    <?php include 'readProductsClassObject.php'; ?>
    <section>
        <?php
        $servername = "localhost";
        $username = "root";
        $password = "pass";
        $dbname = "refsolutions";

        $conn = mysqli_connect($servername, $username, $password, $dbname);

        if (!$conn) {
            die("Connection failed: " . mysqli_connect_error);
        }
        else
        {
            // echo "Successfull Connection";
            echo " ";
        }

        $sql = "SELECT * FROM Products";

        $qryResult = mysqli_query($conn, $sql);
        while($row = mysqli_fetch_assoc($qryResult)) {
            echo "Product Name: ". $row["ProductName"]. " - Description: ". $row["ProductDesc"]. " Price: €" . $row["Price"]."<br>";
        }

        mysqli_close($conn);
        ?>
    </section>
    <?php include 'footer.php'?>
</body>
</html>