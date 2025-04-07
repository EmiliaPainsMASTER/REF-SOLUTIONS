<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sell Form</title>
    <link rel="stylesheet" href="../public/assets/css/main.css">
    <link rel="stylesheet" href="../public/assets/css/layout.css">
</head>
<body>
    <?php include '../templates/header.php'; ?>
    <section>

        <h2 class="title">Sell Form</h2>
        <div class="container">
            <form method="post">
                <label for="fname">First & Last Name</label>
                <input type="text" id="fname" name="firstname" placeholder="Your Name">

                <label for="email">Email</label>
                <input type="email" id="email" name="email" placeholder="Email">

                <label for="item">Item Name</label>
                <input type="text" id="item" name="item" placeholder="Item Name">

                <label for="quantity">Quantity</label>
                <input type="number" id="quantity" name="quantity" placeholder="Quantity">

                <label for="eircode">Eircode</label>
                <input type="text" id="eircode" name="eircode" placeholder="Eircode">

                <label for="country">Country</label>
                <select id="country" name="country">
                    <option value="Ireland">Ireland</option>
                    <option value="UK">UK</option>
                </select>

                <input type="submit" value="Submit">
            </form>
        </div>
    </section>
    <?php include '../templates/footer.php' ?>
</body>
</html>
