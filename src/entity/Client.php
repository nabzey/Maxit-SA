<?php 

namespace App\Entity;
use App\Entity\Client;

class Client{

 private $id;
 private $nom;
 private $prenom;
//  private $telephone;
 private $numero_cin;
 private $photo;

    public function __construct($id='',$nom='',$prenom='',$telephone='',$numero_cin='',$photo='') {
    $this->id=$id;
    $this->nom=$nom;
    $this->prenom=$prenom;
    // $this->telephone=$telephone;
    $this->numero_cin=$numero_cin;
    $this->photo=$photo;
   }
     public static function toObject(array $row): static{
   
  return new static(
            $row['id'],
            $row['nom'], 
            $row['prenom'] ,
            // $row['telephone'],
            $row['numero_cin'],
            $row['photo']   
        );
   }  
   
   public static function toArray(object $object):array {
      return [  
            $row['id'],
            $row['nom'], 
            $row['prenom'] ,
            // $row['telephone'],
            $row['numero_cin'],
            $row['photo']   
      ];
   }
   
}