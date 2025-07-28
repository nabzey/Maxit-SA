<?php
namespace App\Repository;

use App\Core\Abstract\AbstractRepository;
use App\Entity\Compte;

class CompteRepository extends AbstractRepository{
    
    public function __construct() {
        parent::__construct();
    }

    public function find($personneId){
        $sql = 'SELECT solde FROM compte WHERE id_personne = :personneId';
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute(['personneId' => $personneId]);
        $data = $stmt->fetch(\PDO::FETCH_ASSOC);
        return $data ? $data['solde'] : 0.0;
    }

    public function findCompteByPersonneId($personneId){
        $sql = 'SELECT * FROM compte WHERE id_personne = :personneId LIMIT 1';
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute(['personneId' => $personneId]);
        return $stmt->fetch(\PDO::FETCH_ASSOC);
    }
    
    public function insertCompte(Compte $compte): int|false
    {
        try {
            $sql = $this->pdo->prepare("INSERT INTO compte (numerotelephone, numerocni, photorecto, photoverso, solde, estprincipale, id_personne, typecompte)
                VALUES (:numerotelephone, :numerocni, :photorecto, :photoverso, :solde, :estprincipale, :id_personne, :typecompte)");
            $result = $sql->execute([
                ':numerotelephone' => $compte->getNumerotelephone(),
                ':numerocni' => $compte->getNumerocni(),
                ':photorecto' => $compte->getPhotorecto(),
                ':photoverso' => $compte->getPhotoverso(),
                ':solde' => $compte->getSolde(),
                ':estprincipale' => $compte->isEstprincipale(),
                ':id_personne' => $compte->getIdPersonne(),
                ':typecompte' => $compte->getTypecompte()
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
        INSERT INTO compte (id_personne, numerotelephone, solde, typecompte, estprincipale)
        VALUES (:id_personne, :numerotelephone, :solde, :typecompte, :estprincipale)
    ");

     $sql->execute([
        ':id_personne' => $personneId,
        ':numerotelephone' => $telephone,
        ':solde' => $solde,
        ':typecompte' => $type,
        ':estprincipale' => false
    ]);
    return true;
    } catch (\Throwable $th) {
        throw new \Exception($th->getMessage());
        
    }
    
}

public function findByPersonneId(int $personneId): ?array {
    //  var_dump($personneId); die;
    $sql = $this->pdo->prepare("SELECT * FROM compte WHERE id_personne = :personneId AND typecompte = 'principal'");
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
        $sql = $this->pdo->prepare("SELECT * FROM compte WHERE id_personne = :personneId ORDER BY typecompte DESC, id ASC");
        $sql->execute([':personneId' => $personneId]);
        return $sql->fetchAll(\PDO::FETCH_ASSOC);
    }

    /**
     * Change le compte principal d'un utilisateur  
     */
    public function changerComptePrincipal($personneId, $nouveauCompteId): bool {
        try {
            $this->pdo->beginTransaction();
            
            // Désactiver tous les comptes principaux existants
            $sql1 = $this->pdo->prepare("UPDATE compte SET estprincipale = false WHERE id_personne = :personneId");
            $sql1->execute(['personneId' => $personneId]);
            
            // Activer le nouveau compte principal
            $sql2 = $this->pdo->prepare("UPDATE compte SET estprincipale = true WHERE id = :compteId AND id_personne = :personneId");
            $result = $sql2->execute(['compteId' => $nouveauCompteId, 'personneId' => $personneId]);
            
            $this->pdo->commit();
            return $result;
        } catch (\Exception $e) {
            $this->pdo->rollback();
            throw new \Exception("Erreur lors du changement de compte principal : " . $e->getMessage());
        }
    }

    /**
     * Récupère le solde du premier compte trouvé pour la personne (plus de colonne estprincipale)
     */
    public function getSoldeComptePrincipal($personneId): float {
        $sql = $this->pdo->prepare('SELECT solde FROM compte WHERE id_personne = :personneId LIMIT 1');
        $sql->execute(['personneId' => $personneId]);
        $data = $sql->fetch(\PDO::FETCH_ASSOC);
        return $data ? (float)$data['solde'] : 0.0;
    }
}