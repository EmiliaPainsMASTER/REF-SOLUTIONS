<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="css/refSolution.css">
    <link rel="stylesheet" href="css/layout.css">
</head>
<body>
    <?php include 'header.php'?>
    <section>
        <?php
        if (isset($_POST['submit'])) {
            require "config.php";
            try {
                $connection = new PDO($dsn, $username, $password, $options);

                $new_user = array(
                    "fname" => $_POST['fname'],
                    "sname" => $_POST['sname'],
                    "email" => $_POST['email'],
                    "DateofBirth" => $_POST['dob'],
                    "password" => ($_POST['password'])
                );

                $sql = sprintf("INSERT INTO %s (%s) values (%s)", "user",
                    implode(", ", array_keys($new_user)),
                    ":" . implode(", :", array_keys($new_user)));

                $statement = $connection->prepare($sql);
                $statement->execute($new_user);

                echo "Registration successful!";
            } catch (PDOException $error) {
                echo "Error: " . $error->getMessage();
            }
        }
        ?>
        <h2 class="title">Register</h2>

        <div class="container">
            <form method="post">
                <label for="email">Email: </label>
                <input type="email" id="email" name="email" placeholder="Email" required>

                <label for="fname">First Name: </label>
                <input type="text" id="fname" name="fname" placeholder="First Name" required>

                <label for="sname">Surname: </label>
                <input type="text" id="sname" name="sname" placeholder="Surname" required>

                <label for="dob">Date of Birth: </label>
                <input type="date" id="dob" name="dob" placeholder="Date of Birth" required>

                <label for="password">Password: </label>
                <input type="password" id="password" name="password" placeholder="Password" required>
                <input type="submit" name="submit" value="Submit">
            </form>
        </div>
    </section>
    <?php include 'footer.php'?>
</body>
</html>

