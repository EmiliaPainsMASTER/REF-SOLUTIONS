<?php
    $host = "localhost"; 
    $username = "root";        
    $password = "pass";
    $dbname = "refsolutions";
    $dsn = "mysql:host=$host;dbname=$dbname"; 
    $options = array(
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
);
