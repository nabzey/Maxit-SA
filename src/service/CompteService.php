<?php

namespace App\Service;
use App\Core\App;
use App\Repository\CompteRepository;


class CompteService{

 private  CompteRepository $compteRepository;

 public function __construct(CompteRepository $compteRepository) {
    $this->compteRepository =$compteRepository;

 }

 public function getSoldeByPersonneId($personneId) {
    return $this->compteRepository->find($personneId);
 }

    public function getCompteByPersonneId($personneId) {
        return $this->compteRepository->findCompteByPersonneId($personneId);
    }
 public function CompteSecondaire(int $personneId, string $telephone, float $solde): bool {
    $comptePrincipal = $this->compteRepository->findByPersonneId($personneId);

    if (!$comptePrincipal) {
        return false;
    }
   //  var_dump($comptePrincipal); die;
   return $this->compteRepository->insertCompteSecondaire(
        $personneId,
        $telephone,
        $solde,
        'secondaire'
    );
}

public function getComptesByPersonneId($personneId) {
        return $this->compteRepository->getComptesByPersonneId($personneId);
    }


}