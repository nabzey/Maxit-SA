<?php
namespace App\Repository;

use App\Core\Abstract\AbstractRepository;
use App\Entity\Transaction;

class TransactionRepository extends AbstractRepository{
   public  function __construct(){
       parent::__construct(Transaction::class);
    }

    public function getAllTransaction($compteid):array{
       $sql = 'SELECT * FROM transaction WHERE compteid = :compteid';
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute(['compteid' => $compteid]);
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }
     public function insert(){}
     public function update(){}
     public function delete(){}
     public function selectById(int $id){}
     public function selectAll():array{
        return [];
     }
     
     public function selectBy(array $filtre):array{ 
        return [];
     }

}