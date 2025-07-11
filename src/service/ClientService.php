<?php
namespace App\Service;

use App\Repository\ClientRepository;

class ClientService
{
      private ClientRepository $clientRepository;

    public function __construct(\PDO $pdo)
    {
        $this->clientRepository = new ClientRepository($pdo);
    }


    public function findByTelephone(string $telephone): ?array
    {
        return $this->clientRepository->findByTelephone($telephone);
    }

 public function registerClient(array $data, array $files): array
{
    if (empty($data['nom']) || empty($data['prenom']) || empty($data['telephone'])) {
        return ['success' => false, 'message' => 'Veuillez remplir tous les champs obligatoires'];
    }

    $existing = $this->clientRepository->findByTelephone($data['telephone']);
    if ($existing) {
        return ['success' => false, 'message' => 'Ce numéro de téléphone est déjà utilisé'];
    }

    // Préparer les données client (sans gestion upload ici)
    $clientData = [
        'nom' => $data['nom'],
        'prenom' => $data['prenom'],
        'telephone' => $data['telephone'],
        'adresse' => $data['adresse'] ?? null,
        'numero_piece_identite' => $data['numero_piece_identite'] ?? null,
        'photo_recto' => null,
        'photo_verso' => null,
    ];

    $this->clientRepository->insertClient($clientData);

    return ['success' => true, 'message' => 'Client créé avec succès'];
}
    private function uploadFile(array $file): ?string
    {
        if ($file['error'] === UPLOAD_ERR_OK) {
            $ext = pathinfo($file['name'], PATHINFO_EXTENSION);
            $filename = uniqid() . '.' . $ext;
            $destination = __DIR__ . '/../../public/images/upload/' . $filename;
            move_uploaded_file($file['tmp_name'], $destination);
            return $filename;
        }
        return null;
    }
    public function getDashboardData(int $clientId): array
       {
    // Pour exemple futur : récupérer des infos utiles pour le dashboard
    return $this->clientRepository->getClientById($clientId);
}
}
