<?php
    require_once '../Utilities/config.php'; //access the login values
    try {
        $connection = new PDO($dsn, $username, $password, $options);
        //if DB doesn't connect we'll know, won't we?
        //echo 'DB connected';

    } catch (\PDOException $e) {
        throw new \PDOException($e->getMessage(), (int)$e->getCode());
    }