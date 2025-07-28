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
            // Charger la configuration depuis config/database.php
        (   self::$config = require_once __DIR__ . '/../config/database.php');
        
            try {
                $dsn = "pgsql:host=" . self::$config['host'] . ";port=" . self::$config['port'] . ";dbname=" . self::$config['dbname'];
                if (!empty(self::$config['charset'])) {
                    $dsn .= ";options='--client_encoding=" . self::$config['charset'] . "'";
                }
                
                echo "<!-- DEBUG: Tentative de connexion avec DSN: $dsn, User: " . self::$config['user'] . " -->\n";
                
                self::$instance = new PDO(
                    $dsn,
                    self::$config['user'],
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