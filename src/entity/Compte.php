<?php 

namespace App\Entity;
use App\Entity\Compte;

class Compte{

private $id;
private $telephone;
private $montant;
private $date_creation;
private EnumType $type;
private Client $clientId;


public function __construct ($id='',$telephone='',$montant='',$date_creation='',$type = EnumStatu::Principale,$clientId=''){
    $this->id=$id;
    $this->telephone=$telephone;
    $this->montant=$montant;
    $this->date_creation=$date_creation;
    $this->type=$type;
    $this->clientId=$clientId;
}
 public static function toObject(array $row): static{
  return new static (
       $row['id'],
       $row['telephone'],
       $row['montant'],
       $row['date_creation'],
       $row['type'],
       $row['clientId']
  );
 }
  public static function toArray(object $Object){
    
    return[
       $row['id'],
       $row['telephone'],
       $row['montant'],
       $row['date_creation'],
       $row['type'],
       $row['clientId']

    ];
  }

}