<?php

$db_config  = require_once 'db_config.php';

try {
        $db = new PDO(
                "mysql:host={$db_config['db_host']};dbname={$db_config['db_name']};charset=utf8", 
                $db_config['db_user'],  
                $db_config['db_pass'], 
        [
                PDO::ATTR_EMULATE_PREPARES => false,  
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION 
        ]);

        // Return a variable that can later be used when you import this script into some method or function, for example.
        return $db;
} catch (PDOException $error) {
        echo $error->getMessage();
        exit('Database error');
}
?>