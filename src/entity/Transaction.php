<?php 

namespace App\Entity;
use App\Entity\Transaction;

class Transaction {

  private $id;
  private $montant;
  protected EnumType $type; 
  protected EnumSatu $statu; 
  private Compte $compteId;
}