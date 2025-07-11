<?php
namespace App\Service;

use App\Repository\ClientRepository;
use PDOException;

class ClientService
{
    private ClientRepository $clientRepository;

    public function __construct()
    {
        $pdo = new \PDO('pgsql:host=localhost;dbname=ta_base', 'user', 'password');
        $pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);

        $this->clientRepository = new ClientRepository($pdo);
    }

    public function registerClient(array $data, array $files = []): array
    {
        // Validation simple
        if (empty($data['nom']) || empty($data['prenom']) || empty($data['telephone'])) {
            return ['success' => false, 'message' => 'Veuillez remplir tous les champs obligatoires'];
        }

        // Vérifier doublon téléphone
        $existing = $this->clientRepository->findByTelephone($data['telephone']);
        if ($existing) {
            return ['success' => false, 'message' => 'Ce numéro de téléphone est déjà utilisé'];
        }

        $photoRecto = null;
        $photoVerso = null;


        $clientData = [
            'nom' => $data['nom'],
            'prenom' => $data['prenom'],
            'telephone' => $data['telephone'],
            'adresse' => $data['adresse'] ?? null,
            'numero_piece_identite' => $data['numero_piece_identite'] ?? null,
            'photo_recto' => $photoRecto,
            'photo_verso' => $photoVerso,
        ];

        try {
            $this->clientRepository->insertClient($clientData);
        } catch (PDOException $e) {
            if ($e->getCode() === '23505') { 
                return ['success' => false, 'message' => 'Ce numéro de téléphone est déjà utilisé'];
            }
            throw $e;
        }

        return ['success' => true, 'message' => 'Client créé avec succès'];
    }
}
