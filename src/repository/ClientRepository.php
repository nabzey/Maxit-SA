<?php
namespace App\Repository;

use PDO;
use PDOException;

class ClientRepository
{
    private PDO $pdo;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    public function findByTelephone(string $telephone): ?array
    {
        $stmt = $this->pdo->prepare("SELECT * FROM client WHERE telephone = :telephone");
        $stmt->execute([':telephone' => $telephone]);
        $client = $stmt->fetch(PDO::FETCH_ASSOC);
        return $client ?: null;
    }

    public function insertClient(array $clientData): void
    {
        $sql = "INSERT INTO client (nom, prenom, telephone, adresse, numero_piece_identite, photo_recto, photo_verso)
                VALUES (:nom, :prenom, :telephone, :adresse, :numero_piece_identite, :photo_recto, :photo_verso)";

        $stmt = $this->pdo->prepare($sql);

        $stmt->execute([
            ':nom' => $clientData['nom'],
            ':prenom' => $clientData['prenom'],
            ':telephone' => $clientData['telephone'],
            ':adresse' => $clientData['adresse'],
            ':numero_piece_identite' => $clientData['numero_piece_identite'],
            ':photo_recto' => $clientData['photo_recto'],
            ':photo_verso' => $clientData['photo_verso'],
        ]);
    }

    public function getClientById(int $id): ?array
{
    $stmt = $this->pdo->prepare("SELECT * FROM client WHERE id = :id");
    $stmt->execute(['id' => $id]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}
public function save(array $clientData): void
{
    $sql = "INSERT INTO client (nom, prenom, telephone, adresse, numero_piece_identite, photo_recto, photo_verso) 
            VALUES (:nom, :prenom, :telephone, :adresse, :numero_piece_identite, :photo_recto, :photo_verso)";

    $stmt = $this->pdo->prepare($sql);

    $stmt->execute([
        ':nom' => $clientData['nom'],
        ':prenom' => $clientData['prenom'],
        ':telephone' => $clientData['telephone'],
        ':adresse' => $clientData['adresse'],
        ':numero_piece_identite' => $clientData['numero_piece_identite'],
        ':photo_recto' => $clientData['photo_recto'],
        ':photo_verso' => $clientData['photo_verso'],
    ]);
}

}
