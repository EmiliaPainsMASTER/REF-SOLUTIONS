<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="css/css.css">
</head>
<body>
<div class="topnav">
    <a href="index.php">Home</a>
    <a href="About.php">About Us</a>
    <a href="product.php"> Buy Products</a>
    <a href="sell.html">Sell Products</a>
    <a href="history.html">History Items</a>
    <a href="Login.php">Login</a>
    <a href="Register.php">Register</a>
    <form class="searchbar" action="">
        <input type="text" placeholder="Search..">
    </form>
</div>
   <!-- <img src="img/lenovo_thinksystem.jpg">
    <p>The Lenovo ThinkSystem ST50 V2 single-socket tower server is an entry level server ideal for small businesses, home offices, retail, educational institutions and branch offices. The server is based on the Intel Xeon E-2300 Series processors, formerly codenamed "Rocket Lake".<br><br>
    <h1>&euro;850</h1>
    <h3>PRODUCT INFORMATION</h3><br>
    <b>Availability and serviceability</b><br>
    Designed to run 24 hours a day, 7 days a week. The server supports UDIMM memory with ECC protection which provides error correction not available in PC-class "servers" that use parity memory. Avoiding system crashes (and data loss) due to soft memory errors means greater system uptime. Tool-less cover removal provides easy access to upgrades and serviceable parts, such as memory and adapter cards.
    A choice of affordable onboard SATA RAID or advanced hardware RAID redundancy offers data protection and greater system uptime.
    <br><br>
    <b>Powerful and high value</b><br>
    <p>An ideal first server for your growing business, remote/branch office, or retail location, the Lenovo ThinkSystem ST50 V2 enhanced performance increases productivity. The ThinkSystem ST50 V2 boasts the improved operation of the latest Intel® Xeon® E-2300 processors. With a 17% increase in performance the ThinkSystem ST50 V2 offers professional-level capabilities at an entry-level price-point. High value versus a workstation with the benefits of a resilient server.
    </p>-->
    
    
    
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