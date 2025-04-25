<?php
require_once '../src/Models/Admin.php';
?>
<body>
<h2>Admin Test</h2>

<?php
// Create test admin
$admin = new Admin();
$admin->setAdminID(1);
$admin->setAdminName("admin1");
$admin->setAdminEmail("admin@.com");
$admin->setAdminPassword("password");

echo "<div class='admin'>";
echo "<h3>Original Admin</h3>";
echo "<p>Admin name: ".$admin->getAdminname()."</p>";
echo "<p>Email: ".$admin->getAdminEmail()."</p>";
echo "<p>password: ".$admin->getAdminPassword()."</p>";
echo "</div>";

// Update admin
$admin->setAdminname("admin2");
$admin->setAdminEmail("ADMIN2@.com");
    

echo "<h3>Updated Admin</h3>";
echo "<p>New Admin name: ".$admin->getAdminname()."</p>";
echo "<p>Email: ".$admin->getAdminEmail()."</p>";


?>
</body>