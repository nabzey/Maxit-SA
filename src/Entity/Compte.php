<?php

namespace App\Entity;
use App\Entity\enum\TypeCompte;
use App\Core\Abstract\AbstractEntity;

class Compte  extends AbstractEntity {

   private int $id;
   private string $numerotelephone;
   private string $datecreation;
   private string $type;
   private array $transactions;
   private int $personneId;
   private float $solde;

   public function __construct(int $id = 0, string $numerotelephone = '', string $datecreation = '', string $type = '', array $transactions = [], int $personneId = 0, float $solde = 0.0) {
       $this->id = $id;
       $this->numerotelephone = $numerotelephone;
       $this->datecreation = $datecreation;
       $this->type = $type ?: TypeCompte::PRINCIPAL;
       $this->transactions = $transactions;
       $this->personneId = $personneId;
       $this->solde = $solde;
   }
    public function getId(): int {
         return $this->id;
    }         
    public function setId(int $id): void {
        $this->id = $id;
    }
    public function getNumerotelephone(): string {
        return $this->numerotelephone;
    }
    public function setNumerotelephone(string $numerotelephone): void {
        $this->numerotelephone = $numerotelephone;
    }
    public function getDatecreation(): string {
        return $this->datecreation;
    }
    public function setDatecreation(string $datecreation): void {
        $this->datecreation = $datecreation;
    }
    public function getType(): string {
        return $this->type;
    }
    public function setType(string $type): void {
        $this->type = $type;    
    }
    public function getTransactions(): array {
        return $this->transactions;
    }
    public function setTransactions(array $transactions): void {
        $this->transactions = $transactions;
    }
    public function getPersonneId(): int {
        return $this->personneId;
    }
    public function setPersonneId(int $personneId): void {
        $this->personneId = $personneId;
    }
    public function getSolde(): float {
        return $this->solde;
    }
    public function setSolde(float $solde): void {
        $this->solde = $solde;
    }
    public function toArray(): array {
        return [
            'id' => $this->id,
            'numerotelephone' => $this->numerotelephone,
            'datecreation' => $this->datecreation,
            'type' => $this->type,
            'transactions' => $this->transactions,
            'personneId' => $this->personneId,
            'solde' => $this->solde
        ];
    }
    public function toObject($data): object {
        return (object) $data;
    }
    public function toJson(): string {
        return json_encode($this->toArray());
    }

}