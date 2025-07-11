<?php

namespace App\Core;

use PDO;
use PDOException;

class Database
{
    private static ?PDO $connection = null;

    private function __construct()
    {
    }

    public static function getConnection(): PDO
    {
        if (self::$connection === null) {
            try {
                $host = 'localhost';
                $dbname = 'Postgres';
                $user = 'postgres';
                $password = 'Diamniadio14@';

                $dsn = "pgsql:host=$host;dbname=$dbname";
                self::$connection = new PDO($dsn, $user, $password);
                self::$connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            } catch (PDOException $e) {
                throw new \Exception("Erreur de connexion à la base de données : " . $e->getMessage());
            }
        }

        return self::$connection;
    }
}
