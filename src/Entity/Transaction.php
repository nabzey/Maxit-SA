<?php

namespace App\Entity;
use App\Core\Abstract\AbstractEntity;
USE App\Entity\enum\TypeTransaction;
use DateTime;
use App\Entity\Compte;

class Transaction extends AbstractEntity{

    private int $id;
    private float $montant;
    private \DateTime $date;
    private Compte $compteId;
    private TypeTransaction $typeTransaction;

    public function __construct(int $id = 0, float $montant = 0.0, DateTime $date = null, Compte $compteId = null, TypeTransaction $typeTransaction = TypeTransaction::DEPOT) {
        $this->id = $id;
        $this->montant = $montant;
        $this->date = $date ?? new DateTime();
        $this->compteId = $compteId ?? new Compte();
        $this->typeTransaction = $typeTransaction;
    }
  
    public function getId(): int {
        return $this->id;
    }          

    public function setId(int $id): void {
        $this->id = $id;
    }
    public function getMontant(): float {
        return $this->montant;
    }
    public function setMontant(float $montant): void {
         $this->montant = $montant;
    }
    public function getDate(): \DateTime{

        return $this->date ;
    }
    public function setDate(\DateTime $date): void {
        $this->date = $date;
    }
    public function getcompteId(): Compte {
        return $this->compteId;
    }
     public function setcompteId(Compte $compteId): void {
        $this->compteId = $compteId;
    }
     public function getTypeTransaction():TypeTransaction{
        return $this->typeTransaction;
     }
     public function setTypeTransaction(TypeTransaction $typeTransaction):void{
              $this->typeTransaction = $typeTransaction;
     }

     public function toArray(): array{
    return [
      'id' => $this->id,
      'montant'=> $this->montant,
      'date' =>$this->date,
      'compteId'=>$this->compteId,
      'typeTransaction' =>$this->typeTransaction,
    ];
     }

     public function toObject($data): object{
       return (object) $data;
     }  
      public function toJson(): string {
        return json_encode($this->toArray());
    }
}

