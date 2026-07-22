<?php

namespace App\Core;

use PDO;
use PDOException;

class Database {
    private static $instance = null;
    private $pdo;

    private function __construct() {
        $host = Config::get('DB_HOST');
        $db   = Config::get('DB_NAME');
        $user = Config::get('DB_USER');
        $pass = Config::get('DB_PASS');
        $dsn  = "mysql:host=$host;dbname=$db;charset=utf8mb4";

        try {
            $this->pdo = new PDO($dsn, $user, $pass, [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                PDO::ATTR_EMULATE_PREPARES => false,
            ]);
        } catch (PDOException $e) {
            $msg = "Database Connection Error: " . $e->getMessage();
            $msg .= "\n\nPlease check your .env file credentials.";
            $msg .= "\nHost: $host";
            $msg .= "\nDatabase: $db";
            $msg .= "\nUser: $user";
            die("<pre>$msg</pre>");
        }
    }

    public static function getInstance() {
        if (self::$instance === null) {
            self::$instance = new self();
        }
        return self::$instance->pdo;
    }
}
