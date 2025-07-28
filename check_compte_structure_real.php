<?php
require_once 'vendor/autoload.php';
use Dotenv\Dotenv;

$dotenv = Dotenv::createImmutable(__DIR__);
$dotenv->load();

try {
    $dsn = "{$_ENV['DB_DRIVER']}:host={$_ENV['DB_HOST']};port={$_ENV['DB_PORT']};dbname={$_ENV['DB_NAME']}";
    $pdo = new PDO($dsn, $_ENV['DB_USER'], $_ENV['DB_PASSWORD']);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    echo "=== Structure réelle de la table compte ===\n";
    $result = $pdo->query("SELECT column_name, ordinal_position, data_type, column_default FROM information_schema.columns WHERE table_name = 'compte' ORDER BY ordinal_position");
    while ($row = $result->fetch()) {
        printf("%d. %s (%s) - défaut: %s\n", 
            $row['ordinal_position'], 
            $row['column_name'], 
            $row['data_type'], 
            $row['column_default'] ?? 'NULL'
        );
    }
    
    echo "\n=== Contenu actuel de la table compte ===\n";
    $comptes = $pdo->query("SELECT * FROM compte LIMIT 3");
    while ($compte = $comptes->fetch()) {
        print_r($compte);
        echo "---\n";
    }
    
} catch (Exception $e) {
    echo "❌ Erreur: " . $e->getMessage() . "\n";
}
