<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Users</title>
    <link rel="stylesheet" href="../../css/main.css">
    <link rel="stylesheet" href="../../css/layout.css">
</head>



<?php
include "../../templates/header.php";
require "../../templates/loadAllFromUserTable.php";
?>
<body>
<section class="container">
    <h2>Update Users</h2>
    <table>
        <thead>
        <tr>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Email</th>
            <th>Password</th>
            <th>Age</th>
            <th>Edit</th>
        </tr>
        </thead>
        <tbody>
        <?php if (!empty($users)) : ?>
            <?php foreach ($users as $user) : ?>
                <tr>
                    <td><?php echo $user->getFName(); ?></td>
                    <td><?php echo $user->getSName(); ?></td>
                    <td><?php echo $user->getEmail(); ?></td>
                    <td><?php echo $user->getPassword(); ?></td>
                    <td><?php echo $user->getAge(); ?></td>
                    <td><a href="update-single.php?id=<?php echo $user->getUserID(); ?>">Update</a></td>
                </tr>
        <?php endforeach; ?>
        <?php endif; ?>
        </tbody>
    </table>
</section>
<?php include '../../templates/footer.php' ?>
</body>
</html>