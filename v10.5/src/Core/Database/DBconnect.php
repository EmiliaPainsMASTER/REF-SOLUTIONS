<?php
    require_once '../src/Core/Utilities/config.php';
    try {
        $connection = new PDO($dsn, $username, $password, $options);
        
    } catch (\PDOException $e) {
        throw new \PDOException($e->getMessage(), (int)$e->getCode());
    }