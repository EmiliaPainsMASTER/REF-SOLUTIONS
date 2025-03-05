<?php 
$productArray = array("cisco_ucs","dell_poweredge","hpe_proliant","ibm_power_systems","lenovo_thinksystem");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>REF Solutions</title>
    <link rel="stylesheet" href="css/refSolution.css">
    <link rel="stylesheet" href="css/layout.css">
</head>
<body>
    <?php include("header.php") ?>
    <section>
        <h2>Our Top Five bestsellers!</h2>
        <div class="product" id="product2">
            <?php
                for ($count = 0; $count <= 4; $count++) {
                    echo '<img src="img/' . $productArray[$count] . '.jpg">';
            }?>
        </div>
    </section>
    <?php include 'footer.php'?>
</body>
</html>