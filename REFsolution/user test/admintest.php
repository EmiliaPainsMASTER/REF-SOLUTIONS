<?php
require_once '../src/Models/Admin.php';
?>
<body>
<h2>Admin Test</h2>

<?php
    //creating admin
    $admin = new Admin();
    $admin->setAdminID(1);
    $admin->setAdminName("admin1");
    $admin->setAdminEmail("admin@.com");
    $admin->setAdminPassword("password");

    //printing
    echo "<h3>Admin Info</h3>";
    echo "<p>Admin name: ".$admin->getAdminname()."</p>";
    echo "<p>Email: ".$admin->getAdminEmail()."</p>";
    echo "<p>password: ".$admin->getAdminPassword()."</p>";

    //updating admin
    $admin->setAdminname("admin2");
    $admin->setAdminEmail("admin2@.com");

    //printing
    echo "<h3>Updated Admin</h3>";
    echo "<p>Admin name: ".$admin->getAdminname()."</p>";
    echo "<p>Email: ".$admin->getAdminEmail()."</p>";


?>
</body>