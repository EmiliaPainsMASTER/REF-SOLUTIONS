<?php include '../../../templates/crudHead.php'?>
<title>Delete User</title>
</head>

<?php
include "../../templates/header.php";
require "../../templates/loadAllFromUserTable.php";
?>
<body>
<section class="container">
    <h2>Delete Users</h2>
    <table>
        <thead>
        <tr>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Email</th>
            <th>Password</th>
            <th>Age</th>
            <th>Delete</th>
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
                    <td><a href="delete-single.php?id=<?php echo $user->getUserID(); ?>">Delete</a></td>
                </tr>
            <?php endforeach; ?>
        <?php endif; ?>
        </tbody>
    </table>
</section>
<?php include '../../../templates/footer.php' ?>
</body>
</html>