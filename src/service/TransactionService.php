<?php
namespace App\Service;

use App\Repository\TransactionRepository;

class TransactionService {
private  TransactionRepository $transactionRepository;

 public function __construct(TransactionRepository $transactionRepository) {
    $this->transactionRepository =$transactionRepository;
 }

   public function getTransaction($compteid):array{
    return $this->transactionRepository->getAllTransaction($compteid);
   }
}
