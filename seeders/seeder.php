<?php

require_once __DIR__ . '/../vendor/autoload.php';

use Dotenv\Dotenv;

$dotenv = Dotenv::createImmutable(__DIR__ . '/../');
$dotenv->load();

try {
    $dsn = "{$_ENV['DB_DRIVER']}:host={$_ENV['DB_HOST']};port={$_ENV['DB_PORT']};dbname={$_ENV['DB_NAME']}";
    $pdo = new PDO($dsn, $_ENV['DB_USER'], $_ENV['DB_PASSWORD']);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "Connexion réussie à la base de données\n";
} catch (PDOException $e) {
    die("Connexion échouée : " . $e->getMessage());
}

try {
    $pdo->beginTransaction();

    // --- 1. Insertion des personnes ---
    $personnes = [
        ['ba', 'zeynab', '78000001', 'Dakar Liberté 6', 'CNI12', 'client', 'zeynab', 'zeynab123', 'recto1.png', 'verso1.png'],
        ['sow', 'khadija', '770000012', 'Dakar Médina', 'CNI012', 'client', 'zeynab2', 'zeynab123', 'recto2.png', 'verso2.png'],
        ['seck', 'soda', '770000013', 'Rufisque', 'CNI013', 'client', 'zeynab3', 'zeynab123', 'recto3.png', 'verso3.png'],
        ['ndiaye', 'fatima', '770000014', 'Ziguinchor', 'CNI014', 'client', 'zeynab4', 'zeynab123', 'recto4.png', 'verso4.png'],
        ['sall', 'oumou', '770000015', 'Kaolack', 'CNI015', 'client', 'zeynab5', 'zeynab123', 'recto5.png', 'verso5.png'],
        ['sene', 'adama', '770000016', 'Touba', 'CNI016', 'client', 'zeynab6', 'zeynab123', 'recto6.png', 'verso6.png']
    ];

    $stmtPersonne = $pdo->prepare("
        INSERT INTO personne (nom, prenom, telephone, adresse, numerocni, typepersonne, login, password, photorecto, photoverso)
        VALUES (:nom, :prenom, :telephone, :adresse, :numerocni, :typepersonne, :login, :password, :photorecto, :photoverso)
    ");

    $personneIds = [];
    foreach ($personnes as $p) {
        $stmtPersonne->execute([
            ':nom' => $p[0],
            ':prenom' => $p[1],
            ':telephone' => $p[2],
            ':adresse' => $p[3],
            ':numerocni' => $p[4],
            ':typepersonne' => $p[5], // Doit être exactement: client | admin | commercial
            ':login' => $p[6],
            ':password' => $p[7],
            ':photorecto' => $p[8],
            ':photoverso' => $p[9],
        ]);
        $personneIds[] = $pdo->lastInsertId();
    }
    echo "✅ Personnes insérées\n";

    // --- 2. Insertion des comptes ---
    $comptes = [
        ['770000011', 150000, 'principal', $personneIds[0]],
        ['770000012', 120000, 'principal', $personneIds[1]],
        ['770000013', 20000, 'principal', $personneIds[2]],
        ['770000014', 80000, 'principal', $personneIds[3]],
        ['770000015', 30000, 'principal', $personneIds[4]],
        ['770000016', 100000, 'principal', $personneIds[5]],
    ];

    $stmtCompte = $pdo->prepare("
        INSERT INTO compte (numerotelephone, solde, typecompte, id_personne)
        VALUES (:numerotelephone, :solde, :typecompte, :id_personne)
    ");

    $compteIds = [];
    foreach ($comptes as $c) {
        $stmtCompte->execute([
            ':numerotelephone' => $c[0],
            ':solde' => $c[1],
            ':typecompte' => $c[2], // Doit être principal ou secondaire
            ':id_personne' => $c[3],
        ]);
        $compteIds[] = $pdo->lastInsertId();
    }
    echo "✅ Comptes insérés\n";

    // --- 3. Insertion des transactions ---
    $transactions = [
        [10000, $compteIds[0], 'TRANSFERT'],
        [5000, $compteIds[1], 'RETRAIT'],
        [20000, $compteIds[2], 'DEPOT'],
        [15000, $compteIds[3], 'TRANSFERT'],
        [10000, $compteIds[4], 'RETRAIT'],
    ];

    $stmtTransaction = $pdo->prepare("
        INSERT INTO transaction (montant, id_compte, typetransaction)
        VALUES (:montant, :id_compte, :typetransaction)
    ");

    foreach ($transactions as $t) {
        $stmtTransaction->execute([
            ':montant' => $t[0],
            ':id_compte' => $t[1],
            ':typetransaction' => $t[2], // Doit être en MAJUSCULE et existant dans ENUM typetransaction
        ]);
    }
    echo "✅ Transactions insérées\n";

    $pdo->commit();
    echo "🎉 Toutes les données ont été insérées avec succès !\n";

} catch (PDOException $e) {
    $pdo->rollBack();
    die("❌ Erreur d'insertion : " . $e->getMessage() . "\n");
}
