<?php
namespace App\Service;
use App\Repository\PersonneRepository;
use App\Config\ErrorMessage;
use App\Repository\CompteRepository;
use App\Core\App;
use App\Core\Database;
use App\Entity\Personne;

class PersonneService{
    protected PersonneRepository $personneRepository;
    protected CompteRepository $compteRepository;
    private $pdo;

    public function __construct(PersonneRepository $personneRepository, CompteRepository $compteRepository) {
        $this->personneRepository = $personneRepository;
        $this->compteRepository = $compteRepository;
        $this->pdo = Database::getInstance();
    }

    public function findPersonne(string $login, string $password) {
        return $this->personneRepository->login($login, $password); 
    }
// public function enregistrer(Personne $personne, $compte) {
//      var_dump($personne);
//     try {
//         $this->pdo->beginTransaction();
//         $personneCree = $this->personneRepository->selectById($personne->getId());

//         if (!$personneCree || !method_exists($personneCree, 'getId') || $personneCree->getId() <= 0) {
//             $errorInfo = $this->pdo->errorInfo();
//             $this->pdo->rollBack();
//             echo '<pre style="color:red">Erreur PDO Personne : ' . print_r($errorInfo, true) . '</pre>';
//             return ['errors' => ['global' => ['Erreur lors de la création de la personne.']]];
//         }
        
//         $compte->setPersonneId($personneCree->getId());
//         $compte->setNumerotelephone($personneCree->getTelephone());
        
//         // DEBUG : Vérifiez les valeurs avant saveCompte
//         echo '<pre style="color:blue">DEBUG - PersonneId : ' . $compte->getPersonneId() . '</pre>';
//         echo '<pre style="color:blue">DEBUG - Telephone : ' . $compte->getNumerotelephone() . '</pre>';
        
//         $compteIdResult = $this->compteRepository->saveCompte($compte);
//         echo '<pre style="color:blue">DEBUG - Résultat saveCompte : ' . print_r($compteIdResult, true) . '</pre>';
        
//         $compteId = $compteIdResult && isset($compteIdResult['id']) ? $compteIdResult['id'] : 0;
        
//         if ($compteId <= 0) {
//             $errorInfo = $this->pdo->errorInfo();
//             $this->pdo->rollBack();
//             echo '<pre style="color:red">Erreur PDO Compte : ' . print_r($errorInfo, true) . '</pre>';
//             return ['errors' => ['global' => ['Erreur lors de la création du compte.']]];
//         }
        
//         $compte->setId($compteId);
//         $this->pdo->commit();
        
//         echo '<pre style="color:green">SUCCESS - Compte créé avec ID : ' . $compteId . '</pre>';
        
//         return [
//             'personne' => $personneCree,
//             'compte' => $compte
//         ];
        
//     } catch (\Exception $e) {
//         $this->pdo->rollBack();
//         echo '<pre style="color:red">Exception : ' . $e->getMessage() . '</pre>';
//         return ['errors' => ['global' => [$e->getMessage()]]];
//     }
// }
    /**
     * Enregistre une personne et son compte, gère l'upload des fichiers
     * @param array $data
     * @return array
     */
    public function enregistrerPersonne(array $data): array {
        $uploadDir = 'public/images/upload/';
        $rectoPath = '';
        $versoPath = '';
        // Validation des fichiers upload
        if (isset($data['photorecto']) && isset($data['photorecto']['tmp_name']) && $data['photorecto']['error'] === UPLOAD_ERR_OK) {
            $rectoPath = $uploadDir . uniqid() . '_' . basename($data['photorecto']['name']);
            if (!move_uploaded_file($data['photorecto']['tmp_name'], $rectoPath)) {
                return ['errors' => ['global' => ["Erreur lors de l'upload du fichier recto."]]];
            }
        } else {
            return ['errors' => ['global' => ["Fichier recto manquant ou invalide."]]];
        }
        if (isset($data['photoverso']) && isset($data['photoverso']['tmp_name']) && $data['photoverso']['error'] === UPLOAD_ERR_OK) {
            $versoPath = $uploadDir . uniqid() . '_' . basename($data['photoverso']['name']);
            if (!move_uploaded_file($data['photoverso']['tmp_name'], $versoPath)) {
                return ['errors' => ['global' => ["Erreur lors de l'upload du fichier verso."]]];
            }
        } else {
            return ['errors' => ['global' => ["Fichier verso manquant ou invalide."]]];
        }
        // Validation des champs obligatoires
        if (empty($data['nom']) || empty($data['prenom']) || empty($data['login']) || empty($data['password'])) {
            return ['errors' => ['global' => ['Tous les champs obligatoires doivent être remplis.']]];
        }
      
        $personne = new \App\Entity\Personne(
            0,
            $data['nom'] ?? '',
            $data['prenom'] ?? '',
            $data['adresse'] ?? '',
            $data['telephone'] ?? '',
            $rectoPath,
            $versoPath,
            $data['numerocni'] ?? '', // Correction ici
            $data['login'] ?? '',
            $data['password'] ?? '',
            $data['typepersonne'] ?? '' // Correction ici
        );
        $compte = new \App\Entity\Compte(
            0,
            $data['telephone'] ?? '',
            date('Y-m-d'),
            'principal',
            [],
            0,
            0.0
        );
        try {
            $this->pdo->beginTransaction();
            $personneId = $this->personneRepository->insertPersonne($personne);
            if (!$personneId) {
                $this->pdo->rollBack();
                return ['success' => false, 'errors' => ['global' => ["Erreur lors de la création de la personne (ID manquant ou invalide)."]]];
            }
            $resultPersonne = $this->personneRepository->findById($personneId); // Correction ici
            if (!$resultPersonne) {
                $this->pdo->rollBack();
                return ['success' => false, 'errors' => ['global' => ["Erreur lors de la récupération de la personne après insertion."]]];
            }
            $compte->setPersonneId($resultPersonne->getId());
            $compte->setNumerotelephone($resultPersonne->getTelephone());
            $compteId = $this->compteRepository->insertCompte($compte);
            if ($compteId <= 0) {
                $this->pdo->rollBack();
                return ['success' => false, 'errors' => ['global' => [ErrorMessage::accountCreationError->value ?? 'Erreur lors de la création du compte']]];
            }
            $compte->setId($compteId);
            $this->pdo->commit();
            return [
                'personne' => $resultPersonne,
                'compte' => $compte,
                'success' => true
            ];
        } catch (\Exception $e) {
            $this->pdo->rollBack();
            return ['success' => false, 'errors' => ['global' => [$e->getMessage()]]];
        }
    }
}