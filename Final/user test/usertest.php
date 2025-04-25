<?php
require_once '../src/Models/User.php';
?>
<body>
<h2>User Account Test</h2>

<?php
// Create test user
$user = new User();
$user->setUserID(100);
$user->setFName("Alex");
$user->setSName("Johnson");
$user->setEmail("alex@.com");
$user->setAge("1988-07-22");

echo "<div class='user-profile'>";
echo "<h3>New User</h3>";
echo "<p>Name. ".$user->getFName()." ".$user->getSName()."</p>";
echo "<p>Email: ".$user->getEmail()."</p>";
echo "<p>Birth Date: ".$user->getAge()."</p>";
echo "</div>";

// Update user information
$user->setFName("Alexander");
$user->setEmail("alexander@.com");
$user->setAge("1988-07-23"); // Birthday correction

echo "<div class='updated-profile'>";
echo "<h3>Updated User</h3>";
echo "<p>Name. ".$user->getFName()." ".$user->getSName()."</p>";
echo "<p>Email: ".$user->getEmail()."</p>";
echo "<p>Birth Date: ".$user->getAge()."</p>";
echo "</div>";
?>
</body>