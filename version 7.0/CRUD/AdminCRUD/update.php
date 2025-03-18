<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Admins</title>
    <link rel="stylesheet" href="../../css/main.css">
    <link rel="stylesheet" href="../../css/layout.css">
</head>



<?php
include "../../templates/header.php";
require "../../templates/loadAllFromAdminTable.php";
?>
<body>
<section class="container">
    <h2>Update Admins</h2>
    <table>
        <thead>
        <tr>
            <th>Admin Name</th>
            <th>Admin Email</th>
            <th>Admin Password</th>
            <th>Edit</th>
        </tr>
        </thead>
        <tbody>
        <?php if (!empty($admins)) : ?>
        <?php foreach ($admins as $admin) : ?>
        <tr>
                <td><?php echo $admin->getAdminName(); ?></td>
                <td><?php echo $admin->getAdminEmail(); ?></td>
                <td><?php echo $admin->getAdminPassword(); ?></td>
                <td><a href="update-single.php?id=<?php echo $admin->getAdminID(); ?>">Edit</a></td>
            </tr>
        <?php endforeach; ?>
        <?php endif; ?>
        </tbody>
    </table>
</section>
<?php include '../../templates/footer.php' ?>
</body>
</html>