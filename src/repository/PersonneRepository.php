<?php
namespace App\Repository;
use App\Core\Abstract\AbstractRepository;
use App\Entity\Personne;

class PersonneRepository extends AbstractRepository{
    
    public function __construct() {
        parent::__construct();
    }
    
 
    
    public function login(string $login, string $password): ?Personne {
        $sql = "SELECT * FROM personne WHERE login = :login AND password = :password";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([
            ':login' => $login,
            ':password' => $password
        ]);
        $data = $stmt->fetch(\PDO::FETCH_ASSOC);
        if ($data) {
            return new Personne(
                $data['id'] ?? 0,
                $data['nom'] ?? '',
                $data['prenom'] ?? '',
                $data['adresse' ]?? '',
                $data['telephone'] ?? '',
                $data['photorecto' ]?? '',
                $data['photoverso' ]?? '',
                $data['numerocni' ]?? '',
                $data['login'] ?? '',
                $data['password'] ?? '',
                $data['typepersonne' ]?? ''
            );
        }
        return null;
    }
    

public function insertPersonne(Personne $personne): int|false
    {
        try {
            $sql = $this->pdo->prepare("
                INSERT INTO personne (
                    nom, prenom, adresse, telephone, photorecto, photoverso, 
                    numerocni, login, password, typepersonne
                ) VALUES (
                    :nom, :prenom, :adresse, :telephone, :photorecto, :photoverso, 
                    :numerocni, :login, :password, :typepersonne
                )
            ");
            $success = $sql->execute([
                ':nom' => $personne->getNom(),
                ':prenom' => $personne->getPrenom(),
                ':adresse' => $personne->getAdresse(),
                ':telephone' => $personne->getTelephone(),
                ':photorecto' => $personne->getPhotorecto(),
                ':photoverso' => $personne->getPhotoverso(),
                ':numerocni' => $personne->getNumerocni(),
                ':login' => $personne->getLogin(),
                ':password' => $personne->getPassword(),
                ':typepersonne' => $personne->getTypepersonne()
            ]);
            if ($success) {
                return (int) $this->pdo->lastInsertId();
            }
            return false;
        } catch (\PDOException $e) {
            error_log("Erreur lors de l'insertion de la personne: " . $e->getMessage());
            echo '<pre style="color:red">Erreur PDO : ' . $e->getMessage() . '</pre>';
            if (isset(
                $sql) && $sql instanceof \PDOStatement) {
                $errorInfo = $sql->errorInfo();
                echo '<pre style="color:orange">PDO errorInfo : ' . print_r($errorInfo, true) . '</pre>';
            }
            return false;
        }
    }

    public function findById(int $id): ?Personne
    {
        try {
            $sql = $this->pdo->prepare("SELECT * FROM personne WHERE id = :id");
            $sql->execute(['id' => $id]);
            $data = $sql->fetch(\PDO::FETCH_ASSOC);
            if ($data) {
                return new Personne(
                    $data['id'] ?? 0,
                    $data['nom'] ?? '',
                    $data['prenom'] ?? '',
                    $data['adresse'] ?? '',
                    $data['telephone'] ?? '',
                    $data['photorecto'] ?? '',
                    $data['photoverso'] ?? '',
                    $data['numerocni'] ?? '',
                    $data['login'] ?? '',
                    $data['password'] ?? '',
                    $data['typepersonne'] ?? ''
                );
            }
            return null;
        } catch (\PDOException $e) {
            error_log("Erreur lors de la recherche de la personne: " . $e->getMessage());
            return null;
        }
    }

    /**
     * Trouve une personne par son login
     * @param string $login
     * @return Personne|null
     */
    public function findByLogin(string $login): ?Personne
    {
        try {
            $sql = $this->pdo->prepare("SELECT * FROM personne WHERE login = :login");
            $sql->execute(['login' => $login]);
            $data = $sql->fetch(\PDO::FETCH_ASSOC);
            if ($data) {
                return new Personne(
                    $data['id'] ?? 0,
                    $data['nom'] ?? '',
                    $data['prenom'] ?? '',
                    $data['adresse'] ?? '',
                    $data['telephone'] ?? '',
                    $data['photorecto'] ?? '',
                    $data['photoverso'] ?? '',
                    $data['numerocni'] ?? '',
                    $data['login'] ?? '',
                    $data['password'] ?? '',
                    $data['typepersonne'] ?? ''
                );
            }
            return null;
        } catch (\PDOException $e) {
            error_log("Erreur lors de la recherche par login: " . $e->getMessage());
            return null;
        }
    }

    /**
     * Vérifie si un login existe déjà
     * @param string $login
     * @return bool
     */
    public function loginExists(string $login): bool
    {
        try {
            $sql = $this->pdo->prepare("SELECT COUNT(*) FROM personne WHERE login = :login");
            $sql->execute(['login/login' => $login]);
            
            return $sql->fetchColumn() > 0;
            
        } catch (\PDOException $e) {
            error_log("Erreur lors de la vérification du login: " . $e->getMessage());
            return false;
        }
    }

    public function insert(): int|false
    {
        throw new \Exception('Utilisez insertPersonne(Personne) pour insérer une personne.');
    } 
    public function update() { return false; }
    public function delete() { return false; }
    public function selectById(int $id) { return null; }
    public function selectAll(): array { return []; }
    public function selectBy(array $filtre): array { return []; }
}