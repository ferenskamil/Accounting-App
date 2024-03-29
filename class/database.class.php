<?php

class Database {
        private static $instance;
        private $connection;

        private function __construct() {
            // Tworzenie połączenia do bazy danych
            $db_config = require_once __DIR__ . '/../config/database/db_config.php';
        //     $this->connection = new PDO($dbConfig['dsn'], $dbConfig['username'], $dbConfig['password']);

            try {
                $this->connection = new PDO(
                        "mysql:host={$db_config['db_host']};dbname={$db_config['db_name']};charset=utf8",
                        $db_config['db_user'],
                        $db_config['db_pass'],
                [
                        PDO::ATTR_EMULATE_PREPARES => false,
                        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
                ]);
            } catch (PDOException $error) {
                    echo $error->getMessage();
                    exit('Database error');
            }
        }

        public static function getInstance() {
            if (self::$instance === null) {
                self::$instance = new self();
            }
            return self::$instance;
        }

        public function getConnection() {
            return $this->connection;
        }
    }

?>