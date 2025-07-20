<?php
namespace App\Core;

use PDO;
use PDOException;

class Database {
    private static ?PDO $instance = null;
    private static array $config = [];

    private function __construct() {}
    private function __clone() {}

    public static function getInstance(): PDO {
        if (self::$instance === null) {
            self::$config = require dirname(__DIR__) . '/config/database.php';
            try {
                $dsn = "pgsql:host=" . self::$config['host'] .
                       ";dbname=" . self::$config['dbname'];
                if (!empty(self::$config['charset'])) {
                    $dsn .= ";options='--client_encoding=" . self::$config['charset'] . "'";
                }
                self::$instance = new PDO(
                    $dsn,
                    self::$config['username'],
                    self::$config['password'],
                    self::$config['options'] ?? []
                );
            } catch (PDOException $e) {
                throw new \Exception("Erreur de connexion à la base de données: " . $e->getMessage());
            }
        }
        return self::$instance;
    }
}