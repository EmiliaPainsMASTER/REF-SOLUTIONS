<?php
require_once '../src/Models/User.php';
?>
<body>
<h2>User Account Test</h2>

<?php
    //creating user
    $user = new User();
    $user->setUserID(100);
    $user->setFName("Rob");
    $user->setSName("Job");
    $user->setEmail("rob@.com");
    $user->setAge("2000-04-22");

    //printing
    echo "<h3>User</h3>";
    echo "<p>Name. ".$user->getFName()." ".$user->getSName()."</p>";
    echo "<p>Email: ".$user->getEmail()."</p>";
    echo "<p>Birth Date: ".$user->getAge()."</p>";

    //editing user
    $user->setFName("Gon");
    $user->setEmail("gon@.com");
    $user->setAge("2000-04-23");
    
    //printing edit
    echo "<h3>Updated User</h3>";
    echo "<p>Name. ".$user->getFName()." ".$user->getSName()."</p>";
    echo "<p>Email: ".$user->getEmail()."</p>";
    echo "<p>Birth Date: ".$user->getAge()."</p>";
?>
</body>