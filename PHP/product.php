<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="css/refSolution.css">
</head>
<body>
<div class="navbar">
    <a href="index.php">Home</a>
    <a href="about.php">About Us</a>
    <a href="product.php"> Buy Products</a>
    <a href="sell.php">Sell Products</a>
    <a href="history.php">History Items</a>
    <a href="Login.php">Login</a>
    <a href="Register.php">Register</a>
    <form class="searchbar" action="">
        <input type="text" placeholder="Search..">
    </form>
</div>
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
</body>
</html>