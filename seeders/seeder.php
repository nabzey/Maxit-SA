<?php

require_once __DIR__ . '/../vendor/autoload.php';

use Dotenv\Dotenv;

$dotenv = Dotenv::createImmutable(__DIR__ . '/../');
$dotenv->load();


try {
    $dsn = $_ENV['DSN'] ?? "{$_ENV['DB_DRIVER']}:host={$_ENV['DB_HOST']};port={$_ENV['DB_PORT']};dbname={$_ENV['DB_NAME']}";
    $pdo = new PDO($dsn, $_ENV['DB_USER'], $_ENV['DB_PASSWORD']);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "Connexion réussie à la base de données\n";
} catch (PDOException $e) {
    die(" Connexion échouée : " . $e->getMessage());
}

try {
    $pdo->beginTransaction();

    // 1. Personnes
    $personnes = [
        ['ba', 'zeynab', 'Dakar Liberté 6', '770000011', 'CNI011', 'client', 'zeynab', 'zeynab123', 'recto1.png', 'verso1.png'],
        ['sow', 'khadija', 'Dakar Médina', '770000012', 'CNI012', 'client', 'zeynab2', 'zeynab123', 'recto2.png', 'verso2.png'],
        ['seck', 'soda', 'Rufisque', '770000013', 'CNI013', 'client', 'zeynab3', 'zeynab123', 'recto3.png', 'verso3.png'],
        ['ndiaye', 'fatima', 'Ziguinchor', '770000014', 'CNI014', 'client', 'zeynab4', 'zeynab123', 'recto4.png', 'verso4.png'],
        ['sall', 'oumou', 'Kaolack', '770000015', 'CNI015', 'client', 'zeynab5', 'zeynab123', 'recto5.png', 'verso5.png'],
        ['sene', 'adama', 'Touba', '770000016', 'CNI016', 'client', 'zeynab6', 'zeynab123', 'recto6.png', 'verso6.png']
    ];
    $stmtPersonne = $pdo->prepare("INSERT INTO personne (nom, prenom, adresse, telephone, numerocni, typepersonne, login, password, photorecto, photoverso) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $personneIds = [];
    foreach ($personnes as $personne) {
        $stmtPersonne->execute($personne);
        $personneIds[] = $pdo->lastInsertId();
    }
    echo "Personnes insérées\n";

    // 2. Comptes
    $comptes = [
        ['770000011', 150000, $personneIds[0], 'principal'],
        ['770000012', 120000, $personneIds[1], 'principal'],
        ['770000013', 20000, $personneIds[2], 'principal'],
        ['770000014', 80000, $personneIds[3], 'principal'],
        ['770000015', 30000, $personneIds[4], 'principal'],
        ['770000016', 100000, $personneIds[5], 'principal'],
    ];
    
    $stmtCompte = $pdo->prepare("INSERT INTO compte (telephone, solde, personneid, type) VALUES (?, ?, ?, ?)");
    $compteIds = [];
    foreach ($comptes as $compte) {
        $stmtCompte->execute($compte);
        $compteIds[] = $pdo->lastInsertId();
    }
    echo "Comptes insérés\n";

    // 3. Transactions
    $transaction = [
        ['2025-07-18 12:00:00', 10000, 'transfert', $compteIds[0]],
        ['2025-07-18 14:00:00', 5000, 'retrait', $compteIds[1]],
        ['2025-07-18 15:00:00', 20000, 'depot', $compteIds[2]],
        ['2025-07-18 16:00:00', 15000, 'transfert', $compteIds[3]],
        ['2025-07-18 17:00:00', 10000, 'retrait', $compteIds[5]],
    ];
    $stmtTrx = $pdo->prepare("INSERT INTO transaction (date, montant, typetransaction, compteid) VALUES (?, ?, ?, ?)");
    foreach ($transaction as $trx) {
        $stmtTrx->execute($trx);
    }
    echo "Transactions insérées\n";

    // Fin de transaction
    $pdo->commit();
    echo " Toutes les données ont été insérées avec succès dans une transaction.\n";

} catch (PDOException $e) {
    $pdo->rollBack();
    die("Erreur lors de l'insertion des données : " . $e->getMessage());
}