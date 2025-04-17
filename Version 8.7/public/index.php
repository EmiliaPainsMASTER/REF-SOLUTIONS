<?php
session_start();
$productArray = array("cisco_ucs", "dell_poweredge", "hpe_proliant", "ibm_power_systems", "lenovo_thinksystem");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>REF Solutions</title>
    <link rel="stylesheet" href="assets/css/layout.css">
    <link rel="stylesheet" href="assets/css/main.css">
    <link rel="stylesheet" href="assets/css/index.css">
</head>
<body>
    <?php include '../templates/header.php' ?>

    

    <section class="dropdown-section">
        <h2>Browse by Category</h2>
        <div class="dropdown-row">
            <div class="dropdown-group">
                <label for="computers">Computers</label>
                <select id="computers" name="computers">
                    <option value="">-- Select a brand --</option>
                    <option value="dell">Dell</option>
                    <option value="hp">HP</option>
                    <option value="lenovo">Lenovo</option>
                    <option value="apple_computer">Apple</option>
                    <option value="asus">Asus</option>
                </select>
            </div>

            <div class="dropdown-group">
                <label for="phones">Phones</label>
                <select id="phones" name="phones">
                    <option value="">-- Select a brand --</option>
                    <option value="apple_phone">Apple</option>
                    <option value="samsung">Samsung</option>
                    <option value="google">Google</option>
                    <option value="oneplus">OnePlus</option>
                    <option value="xiaomi">Xiaomi</option>
                </select>
            </div>

            <div class="dropdown-group">
                <label for="electronics">Other Electronics</label>
                <select id="electronics" name="electronics">
                    <option value="">-- Select a brand --</option>
                    <option value="sony">Sony</option>
                    <option value="lg">LG</option>
                    <option value="panasonic">Panasonic</option>
                    <option value="philips">Philips</option>
                    <option value="toshiba">Toshiba</option>
                </select>
            </div>
        </div>
    </section>

    <?php include '../templates/footer.php' ?>
</body>
</html>
