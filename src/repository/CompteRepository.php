<?php
namespace App\Repository;

namespace App\Repository;

use App\Core\Database;
use App\Entity\Compte;
use PDO;

class CompteRepository
{
    private PDO $pdo;

    public function __construct()
    {
        $this->pdo = Database::getConnection();
    }

    public function save(Compte $compte): void
    {
        $stmt = $this->pdo->prepare("INSERT INTO compte (numero, type, client_id, solde) VALUES (?, ?, ?, ?)");
        $data = $compte->toArray();
        $stmt->execute([
            $data['numero'],
            $data['type'],
            $data['client_id'],
            $data['solde']
        ]);
    }
}