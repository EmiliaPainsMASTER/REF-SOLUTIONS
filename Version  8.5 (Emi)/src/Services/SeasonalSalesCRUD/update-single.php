<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Seasonal Sale</title>
    <link rel="stylesheet" href="../../../public/assets/css/main.css">
    <link rel="stylesheet" href="../../../public/assets/css/layout.css">
</head>
<?php require "../../templates/header.php"; ?>
<?php
require "../../DBtoPages/common.php";
require_once '../../DBtoPages/DBconnect.php';
require_once '../../DBtoObjects/SeasonalSale.php';

if (isset($_POST['submit'])) {
    try {
        $seasonalSale = SeasonalSale::loadFromDB($_POST['id'], $connection);
        $seasonalSale->setSeasonalSaleEasterProducts($_POST['EasterProducts']);
        $seasonalSale->setSeasonalSaleStPatricksDayProducts($_POST['StPatricksProducts']);
        if ($seasonalSale->updateDB($connection)) {
            header("Location: update.php");
            exit;
        } else {
            echo "Failed to update the seasonal sale.";
        }
    } catch (Exception $e) {
        echo $e->getMessage();
    }
}

if (isset($_GET['id'])) {
    $seasonalSale = SeasonalSale::loadFromDB($_GET['id'], $connection);
} else {
    echo "Something went wrong between lines 32-35!";
    exit;
}
?>
<body>
<section>
    <h2 class="title">Edit a Seasonal Sale</h2>
    <div class="container">
        <form method="post" action="update-single.php">
            <input type="hidden" name="id" value="<?php echo $seasonalSale->getSeasonalSaleID(); ?>">
            <label for="EasterProducts">Easter Products</label>
            <input type="text" id="EasterProducts" name="EasterProducts" value="<?php echo $seasonalSale->getSeasonalSaleEasterProducts(); ?>">

            <label for="StPatricksProducts">St Patricks Day Products</label>
            <input type="text" id='StPatricksProducts' name="StPatricksProducts" value="<?php echo $seasonalSale->getSeasonalSaleStPatricksDayProducts(); ?>">

            <input type="submit" name="submit" value="Submit">
        </form>
    </div>
    <a href="update.php">Back to Seasonal Sales</a>
</section>
<?php require "../../templates/footer.php"; ?>
</body>
</html>