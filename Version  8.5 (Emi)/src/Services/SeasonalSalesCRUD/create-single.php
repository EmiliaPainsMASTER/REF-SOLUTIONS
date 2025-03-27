<?php include '../../../templates/crudHead.php'?>
<title>Create</title>
</head>
<?php require "../../templates/header.php"; ?>
<?php
require "../../DBtoPages/common.php";
require_once '../../DBtoPages/DBconnect.php';
require_once '../../DBtoObjects/SeasonalSale.php';

if (isset($_POST['submit'])) {
    try {
        $seasonalSale = new SeasonalSale();
        $seasonalSale->setSeasonalSaleEasterProducts($_POST['EasterProducts']);
        $seasonalSale->setSeasonalSaleStPatricksDayProducts($_POST['StPatricksProducts']);
        if ($seasonalSale->insertDB($connection)) {
            header("Location: ../../index.php");
            exit;
        } else {
            echo "Failed to insert the seasonal sale.";
        }
    } catch (Exception $e) {
        echo $e->getMessage();
    }
}
?>
<body>
<section>
    <h2 class="title">Create a Seasonal Sale</h2>
    <div class="container">
        <form method="post" action="create-single.php">
            <label for="EasterProducts">Easter Products</label>
            <input type="text" name="EasterProducts" id="EasterProducts" placeholder="Easter Products">

            <label for="StPatricksProducts">St. Patrick's Day Products</label>
            <input type="text" name="StPatricksProducts" id="StPatricksProducts" placeholder="St. Patrick's Day Products">

            <input type="submit" name="submit" value="Submit">
        </form>
    </div>
    <a href="../../../public/index.php">Back to Home</a>
</section>
<?php require "../../../templates/footer.php"; ?>
</body>
</html>