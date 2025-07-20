<?php
namespace App\Repository;

use App\Core\Abstract\AbstractRepository;
use App\Entity\Compte;

class CompteRepository extends AbstractRepository{
    
    public function __construct() {
        parent::__construct();
    }

    public function find($personneId){
        $sql = 'SELECT solde FROM compte WHERE personneId = :personneId';
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute(['personneId' => $personneId]);
        $data = $stmt->fetch(\PDO::FETCH_ASSOC);
        return $data ? $data['solde'] : 0.0;
    }

    public function findCompteByPersonneId($personneId){
        $sql = 'SELECT * FROM compte WHERE personneId = :personneId LIMIT 1';
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute(['personneId' => $personneId]);
        return $stmt->fetch(\PDO::FETCH_ASSOC);
    }
    
    public function insertCompte(Compte $compte): int|false
    {
        try {
            $sql = $this->pdo->prepare("INSERT INTO compte (telephone, datecreation, type, solde, personneId)
                VALUES (:telephone, :datecreation, :type, :solde, :personneId)");
            $result = $sql->execute([
                ':telephone' => $compte->getNumerotelephone(),
                ':datecreation' => $compte->getDatecreation(),
                ':type' => $compte->getType(),
                ':solde' => $compte->getSolde(),
                ':personneId' => $compte->getPersonneId()
            ]);
            if ($result) {
                return (int) $this->pdo->lastInsertId();
            } else {
                return false;
            }
        } catch (\PDOException $e) {
            return false;
        }
    }
 public function insertCompteSecondaire(int $personneId, string $telephone, float $solde, string $type = 'secondaire'): bool {
    try {
        // var_dump($personneId); die;
        $sql = $this->pdo->prepare("
        INSERT INTO compte (personneId, telephone, solde, type)
        VALUES (:personneId, :telephone, :solde, :type)
    ");

     $sql->execute([
        ':personneId' => $personneId,
        ':telephone' => $telephone,
        ':solde' => $solde,
        ':type' => $type
    ]);
    return true;
    } catch (\Throwable $th) {
        throw new \Exception($th->getMessage());
        
    }
    
}

public function findByPersonneId(int $personneId): ?array {
    //  var_dump($personneId); die;
    $sql = $this->pdo->prepare("SELECT * FROM compte WHERE personneId = :personneId AND type = 'principal'");
    $sql->execute([':personneId' => $personneId]);

    $result = $sql->fetch(\PDO::FETCH_ASSOC);
    return $result ?: null;
}

    public function insert() {
        // Méthode abstraite, à adapter selon la logique métier
        throw new \Exception('Utilisez insertCompte(Compte) pour insérer un compte.');
    }
    
    public function update(){}
    public function delete(){}
    public function selectById(int $id){}
    public function selectAll():array{
        return [];
    }
    
    public function selectBy(array $filtre):array{ 
        return [];
    }
    public function getComptesByPersonneId($personneId): array {
        $sql = $this->pdo->prepare("SELECT * FROM compte WHERE personneId = :personneId ORDER BY type DESC, id ASC");
        $sql->execute([':personneId' => $personneId]);
        return $sql->fetchAll(\PDO::FETCH_ASSOC);
    }
}